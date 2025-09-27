<?php

use App\Http\Controllers\PosyanduController;

Route::get('/posyandu', [PosyanduController::class, 'index']);