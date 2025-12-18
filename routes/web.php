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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. Rute Publik (Guest) ---

// Root diarahkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman Login & Proses Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Semua rute di sini mengharuskan user sudah login (Middleware: checkislogin)
Route::middleware(['checkislogin'])->group(function () {

    // Dashboard / Home
    // Menggunakan Route::get() agar nama rutenya 'home' (memperbaiki error redirect loop)
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // --- Menu yang bisa diakses oleh SEMUA user yang login (Kader & Admin) ---
    Route::resource('posyandu', PosyanduController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('kader', KaderPosyanduController::class);
    
    // Jadwal Posyandu
    Route::resource('jadwal-posyandu', JadwalPosyanduController::class)->except(['show']);
    Route::get('jadwal-posyandu/{jadwal}', [JadwalPosyanduController::class, 'show'])->name('jadwal-posyandu.show');
    
    // Imunisasi & Layanan
    Route::resource('imunisasi', CatatanImunisasiController::class);
    Route::resource('layanan', LayananPosyanduController::class);
    
    // Delete Media Routes
    Route::get('media/delete/imunisasi/{id}', [CatatanImunisasiController::class, 'deleteMedia'])->name('media.delete.imunisasi');
    Route::get('/media/delete/{id}', [PosyanduController::class, 'deleteMedia'])->name('media.delete');
    Route::get('media/delete/layanan/{id}', [LayananPosyanduController::class, 'deleteMedia'])->name('media.delete.layanan');


    // --- 3. Rute Khusus ADMIN ---
    // Menu 'User' hanya bisa diakses jika role-nya Admin
    Route::middleware(['checkrole:Admin'])->group(function () {
        Route::resource('user', UserController::class);
    });

});