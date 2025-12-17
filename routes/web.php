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

// --- 1. Rute Publik (Login/Logout) ---

// Root diarahkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman Login & Proses Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// --- 2. Rute Terproteksi (Harus Login) ---
// Menggabungkan semua rute yang butuh login ke dalam satu grup middleware 'checkislogin'

Route::middleware(['checkislogin'])->group(function () {
    
    // Dashboard / Home
    // PENTING: Kita gunakan get() eksplisit agar nama rute 'home' terbaca jelas oleh LoginController
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Resource Controller
    // Note: 'home' resource dihapus karena sudah ada Route::get('/home') di atas untuk menghindari konflik nama.
    
    Route::resource('posyandu', PosyanduController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class);
    Route::resource('kader', KaderPosyanduController::class);
    
    // Jadwal Posyandu
    Route::resource('jadwal-posyandu', JadwalPosyanduController::class)->except(['show']);
    Route::get('jadwal-posyandu/{jadwal}', [JadwalPosyanduController::class, 'show'])->name('jadwal-posyandu.show');
    
    // Imunisasi
    Route::resource('imunisasi', CatatanImunisasiController::class);
    Route::get('media/delete/imunisasi/{id}', [CatatanImunisasiController::class, 'deleteMedia'])->name('media.delete.imunisasi');
    
    // Layanan & Media
    Route::get('/media/delete/{id}', [PosyanduController::class, 'deleteMedia'])->name('media.delete');
    Route::resource('layanan', LayananPosyanduController::class);
    Route::get('media/delete/layanan/{id}', [LayananPosyanduController::class, 'deleteMedia'])->name('media.delete.layanan');

    // --- 3. Rute Khusus Admin (Nested Group) ---
    // Rute ini hanya bisa diakses jika user login DAN memiliki role Admin
    Route::middleware(['checkrole:Admin'])->group(function () {
        // Hati-hati: route 'user.index' ini mungkin menimpa resource 'user' di atas.
        // Pastikan UserController@index di sini memang khusus untuk admin.
        Route::get('user-admin', [UserController::class, 'index'])->name('user.admin.index'); 
    });
});