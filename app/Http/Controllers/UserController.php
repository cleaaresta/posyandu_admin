<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage; // Tambahkan
use App\Models\Media; // Tambahkan

class UserController extends Controller
{
    public function index(Request $request)
    {
        $searchableColumns = ['name', 'email'];
        $filterableColumns = [];

        // Eager load 'foto' agar tidak N+1 Query
        $users = User::with('foto')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        $roles = [
            'admin' => 'Admin',
            'guest' => 'Guest',
            // Tambahkan role lain jika ada
        ];

        return view('pages.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:guest,admin', // Sesuaikan dengan enum database
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi Foto
        ]);

        // 1. Buat User
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        // 2. Upload Foto (Jika ada)
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $path = $file->store('uploads/users', 'public');

            $user->foto()->create([
                'ref_table' => 'users',
                'file_url'  => $path,
                'caption'   => 'Foto Profil ' . $user->name,
                'mime_type' => $file->getClientMimeType(),
            ]);
        }

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = [
            'admin' => 'Admin',
            'guest' => 'Guest',
        ];

        return view('pages.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:guest,admin',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi Foto
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        // 3. Handle Update Foto
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama fisik & database
            if ($user->foto) {
                if (Storage::disk('public')->exists($user->foto->file_url)) {
                    Storage::disk('public')->delete($user->foto->file_url);
                }
                $user->foto()->delete();
            }

            // Upload baru
            $file = $request->file('foto_profil');
            $path = $file->store('uploads/users', 'public');

            $user->foto()->create([
                'ref_table' => 'users',
                'file_url'  => $path,
                'caption'   => 'Foto Profil ' . $user->name,
                'mime_type' => $file->getClientMimeType(),
            ]);
        }

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (auth()->check() && auth()->id() === $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun yang sedang aktif.');
        }

        // Hapus Foto Profil sebelum hapus user
        if ($user->foto) {
            if (Storage::disk('public')->exists($user->foto->file_url)) {
                Storage::disk('public')->delete($user->foto->file_url);
            }
            // Record DB akan terhapus via Cascade Delete atau bisa manual:
            // $user->foto()->delete(); 
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}