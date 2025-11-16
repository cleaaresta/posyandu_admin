<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\JadwalPosyanduController;

Route::group(['middleware' => 'web'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('home', HomeController::class);
    Route::resource('posyandu', PosyanduController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class);
    Route::resource('jadwal-posyandu', JadwalPosyanduController::class)->except(['show']);

});
