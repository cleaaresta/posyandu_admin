<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/', function () {
        return redirect()->route('home');
    });
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('home', HomeController::class);
    Route::resource('posyandu', PosyanduController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class);
});
