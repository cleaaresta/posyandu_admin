<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
     */
    public function showLoginForm()
    {
        // Jika user sudah login, lempar ke 'home' (sesuai sidebar)
        if (Auth::check()) {
            return redirect()->route('home'); // UBAH INI
        }
        // Tampilkan view login
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input: email dan password wajib diisi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Cek apakah email ada di database
        $user = User::where('email', $credentials['email'])->first();

        // 3. Cek user dan password (Logika Hash::check sudah benar)
        if ($user && Hash::check($credentials['password'], $user->password)) {

            // 4. Jika berhasil, loginkan user (buat session)
            Auth::login($user);

            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // 5. Redirect ke 'home' (sesuai sidebar)
           return redirect()->intended('home')->with('success', 'Login berhasil! Selamat datang.');
        }

        // 6. Jika gagal, kembali ke halaman login dengan pesan error
       return back()->withErrors([
            'email' => 'Email atau Password yang Anda masukkan salah',
        ])->onlyInput('email'); // Baris ini yang memicu @error('email')
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login'); // UBAH INI
    }
}
