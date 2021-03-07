<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

Route::get('/', [LinkController::class, 'index'])->name('index');

Route::get('/stat/{statLink?}', [LinkController::class, 'stat'])->name('stat');

Route::post('/save', [LinkController::class, 'save'])->name('save');

Route::get('/{link}', [LinkController::class, 'redirect'])->name('redirect');
