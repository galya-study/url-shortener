<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLinkRequest;
use App\Models\Link;
use App\Models\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function save(SaveLinkRequest $request)
    {
        $validated = $request->validated();
        $data = [
            'url' => $validated['url'],
            'link' => $validated['link'] ?? Str::random(8),
            'is_commercial' => (bool) $validated['is_commercial'],
            'expires_at' => is_null($validated['expires_at']['date'])
                ? null
                : Carbon::parse($validated['expires_at']['date'] . ' ' . $validated['expires_at']['time'] ?? '00:00'),
            'stat_link' => Str::random(8),
        ];

        $link = Link::create($data);

        return view('link', ['link' => $link]);
    }

    public function redirect($link)
    {
        $linkModel = Link::where('link', $link)->first();

        if (is_null($linkModel) || (!is_null($linkModel->expires_at) && $linkModel->expires_at < Carbon::now())) {
            abort(404);
        }

        if ($linkModel->is_commercial) {
            $images = Storage::disk('public')->files('commercial');
            $images = array_filter($images, function ($image) {
                $ext = pathinfo($image, PATHINFO_EXTENSION);
                return in_array($ext, ['jpg', 'png', 'jpeg']);
            });
            
            $image = Arr::random($images);

            $response = view('image', [
                'url' => $linkModel->url,
                'image' => env('APP_URL') . 'storage/' . $image,
            ]);
        } else {
            $response = redirect()->away($linkModel->url);
        }

        $redirect = new Redirect();
        $redirect->link_id = $linkModel->id;
        $redirect->ip_address = Request::ip();
        $redirect->image = $linkModel->is_commercial ? $image : null;

        $redirect->save();

        return $response;
    }

    public function stat(string $statLink = null)
    {
        if (is_null($statLink)) {
            $links = Link::with('redirects')->get();

            return view('stat-global', [
                'links' => $links,
            ]);
        } else {
            $link = Link::where('stat_link', $statLink)->first();

            if (is_null($link)) {
                abort(404);
            }

            return view('stat-local', [
                'redirects' => $link->redirects()->orderByDesc('created_at')->get(),
                'link' => $link,
            ]);
        }
    }
}
