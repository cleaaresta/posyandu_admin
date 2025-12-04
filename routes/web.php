<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\KaderPosyanduController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\LayananPosyanduController;
use App\Http\Controllers\CatatanImunisasiController;

// Rute login tetap di LUAR middleware proteksi
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Root diarahkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Logout (POST)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Gunakan alias 'checkislogin' yang sudah didaftarkan di app.php
Route::middleware('checkislogin')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // rute lain yang butuh autentikasi...
});

// Grup rute yang dilindungi oleh middleware checkislogin
Route::group(['middleware' => 'checkislogin'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('home', HomeController::class);
    Route::resource('posyandu', PosyanduController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class);
    Route::resource('jadwal-posyandu', JadwalPosyanduController::class)->except(['show']);
    Route::resource('kader', KaderPosyanduController::class);
    Route::get('jadwal-posyandu/{jadwal}', [JadwalPosyanduController::class, 'show'])->name('jadwal-posyandu.show');
    Route::resource('imunisasi', CatatanImunisasiController::class);
    Route::get('media/delete/imunisasi/{id}', [CatatanImunisasiController::class, 'deleteMedia'])->name('media.delete.imunisasi');
    Route::get('/media/delete/{id}', [PosyanduController::class, 'deleteMedia'])->name('media.delete');
    Route::resource('layanan', LayananPosyanduController::class);
    Route::get('media/delete/layanan/{id}', [LayananPosyanduController::class, 'deleteMedia'])->name('media.delete.layanan');
});

Route::group(['middleware' => 'checkrole:Admin'], function () {
    Route::get('user', [UserController::class, 'index'])->name('user.index');
});