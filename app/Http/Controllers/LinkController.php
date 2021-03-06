<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LinkRequest;

class LinkController extends Controller
{
    public function submit(LinkRequest $request)
    {
        return $request->all();
    }
}
