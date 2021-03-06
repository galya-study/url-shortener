<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/stat', function () {
    return view('stat');
})->name('stat');

Route::post('/createShortLink', [LinkController::class, 'submit'])->name('createShortLink');
