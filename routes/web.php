<?php

use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\AuthController;

Route::get('/posyandu', [PosyanduController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);