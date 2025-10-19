<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;

// Daftarkan semua 7 route CRUD untuk warga
Route::resource('warga', WargaController::class);
