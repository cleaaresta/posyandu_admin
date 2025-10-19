<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('auth.login');
    }

    // Handle logika form login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Jika username dan password sama (misal nim)
        if ($request->username === $request->password) {
            return redirect()->route('dashboard')->with('success', 'Selamat Datang Admin!');
        } else {
            return back()->with('error', 'Username dan password harus sama.');
        }
    }

    // Handle logika form register
    public function register(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'regex:/^[^0-9]+$/'],
            'alamat' => 'required|max:300',
            'tanggal_lahir' => 'required|date',
            'username' => 'required',
            'password' => [
                'required',
                'min:6',
                'regex:/[A-Z]/',
                'regex:/[0-9]/'
            ],
            'confirm_password' => 'required|same:password'
        ], [
            'nama.regex' => 'Nama tidak boleh mengandung angka.',
            'alamat.max' => 'Alamat maksimal 300 karakter.',
            'tanggal_lahir.date' => 'Tanggal lahir harus bertipe tanggal.',
            'password.regex' => 'Password harus mengandung huruf kapital dan angka.',
            'confirm_password.same' => 'Password dan Confirm Password harus sama.'
        ]);

        // Simulasi penyimpanan user (bisa tambahkan logic ke database)
        // ...

        return redirect()->route('auth.index')->with('success', 'Registrasi berhasil! Silakan Login.');
    }
}
