<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\LoginController; // Pastikan ini LoginController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Kita bungkus SEMUA rute dengan middleware 'web' untuk memastikan
| session, CSRF, dan pesan pop up (sukses/error) berfungsi.
|
*/
Route::group(['middleware' => 'web'], function () {

    /*
    |--------------------------------------------------------------------------
    | Rute Publik (Bisa diakses tanpa login)
    |--------------------------------------------------------------------------
    */
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login']);

    // Redirect halaman utama ('/') ke 'home'
    Route::get('/', function () {
        return redirect()->route('home');
    });

    /*
    |--------------------------------------------------------------------------
    | Rute Terproteksi (WAJIB LOGIN)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth'])->group(function () {

        // Route untuk Logout
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        // Route untuk Home (Dashboard Anda)
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::resource('home', HomeController::class);

        // Route Posyandu
        Route::resource('posyandu', PosyanduController::class);

        // Route Warga
        Route::resource('warga', WargaController::class);

        // Route User
        Route::resource('user', UserController::class);

    }); // Akhir dari middleware 'auth'

}); // Akhir dari middleware 'web'
