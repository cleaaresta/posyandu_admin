<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
       public function index()
    {
        // Menampilkan form login
        return view('login-form');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => [
                'required',
                'min:3',
                'regex:/[A-Z]/'
            ]
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 3 karakter.',
            'password.regex' => 'Password harus mengandung huruf kapital.'
        ]);

        // Cek username dan password sama
        if ($request->username === $request->password) {
            return view('success', ['username' => $request->username]);
        } else {
            return redirect('/auth')->with('error', 'Username dan password harus sama.');
        }
    }
}