<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user.
     */
    public function index()
    {
        $users = User::paginate(10); // Menggunakan pagination
        return view('pages.user.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru.
     */
    public function create()
    {
        return view('admin1.user.create');
    }

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')
                         ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * (Opsional) Menampilkan detail satu user.
     * Kita redirect ke index saja.
     */
    public function show(User $user)
    {
        return redirect()->route('user.index');
    }

    /**
     * Menampilkan form untuk mengedit user.
     */
    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Mengupdate data user di database.
     */
    public function update(Request $request, User $user)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            // Pastikan email unik, tapi abaikan user saat ini
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Password bersifat opsional (nullable) saat update
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // Siapkan data untuk di-update
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Jika password diisi, hash dan tambahkan ke data
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update user
        $user->update($data);

        return redirect()->route('user.index')
                         ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus user dari database.
     */
    public function destroy(User $user)
    {
        // (Opsional) Tambahkan logika agar tidak bisa menghapus diri sendiri
        // if ($user->id == auth()->id()) {
        //     return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        // }

        $user->delete();

        return redirect()->route('user.index')
                         ->with('success', 'User berhasil dihapus.');
    }
}
