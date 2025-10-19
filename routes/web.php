<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route; // Pastikan ini ada
use App\Http\Controllers\WargaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk Home
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('home', HomeController::class);

// INI ADALAH ROUTE UNTUK POSYANDU
// Ini akan otomatis membuat URL /posyandu (GET), /posyandu (POST),
// /posyandu/{id}/edit (GET), /posyandu/{id} (PUT/DELETE), dll.
Route::resource('posyandu', PosyanduController::class);

// <-- 2. TAMBAHKAN BLOK INI UNTUK WARGA -->
// INI ADALAH ROUTE UNTUK WARGA
Route::resource('warga', WargaController::class);
Route::middleware('web')
    ->group(base_path('routes/warga.php'));
