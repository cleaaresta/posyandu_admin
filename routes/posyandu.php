<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PosyanduController;
use Illuminate\Support\Facades\Route;

Route::resource('home', HomeController::class);
Route::resource('posyandu', PosyanduController::class);

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
