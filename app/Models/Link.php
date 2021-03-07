<?php

namespace App\Models;

use App\Http\Requests\SaveLinkRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $table = 'links';

    protected $fillable = [
        'url',
        'link',
        'expires_at',
        'is_commercial',
        'stat_link',
    ];

    protected $casts = [
        'is_commercial' => 'bool',
    ];

    protected $dates = [
        'expires_at',
    ];

    public function getFullLinkAttribute()
    {
        return env('APP_URL') .  $this->link;
    }

    public function getFullStatLinkAttribute()
    {
        return env('APP_URL') . 'stat/' .  $this->stat_link;
    }

    public function getIsCommercialAsStringAttribute()
    {
        return $this->is_commercial ? 'да' : 'нет';
    }

    public function redirects()
    {
        return $this->hasMany(Redirect::class, 'link_id', 'id');
    }
}
