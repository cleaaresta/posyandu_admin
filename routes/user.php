<?php
use App\Http\Controllers\UserController;

// ... (rute Anda yang lain, seperti Posyandu) ...

Route::resource('user', UserController::class);

