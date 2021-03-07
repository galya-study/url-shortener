<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasFactory;

    protected $table = 'redirects';

    public function getImageUrlAttribute()
    {
        return env('APP_URL') . 'storage/' . $this->image;
    }
}
