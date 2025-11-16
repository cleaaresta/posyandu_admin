<?php
// NAMA FILE: app/Http/Controllers/JadwalPosyanduController.php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use App\Models\Posyandu; // <-- Import Posyandu
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JadwalPosyanduController extends Controller
{
    // Folder untuk menyimpan poster
    private $storagePath = 'public/jadwal_posters';

    public function index()
    {
        // Ambil jadwal, lakukan Eager Loading (with) untuk relasi 'posyandu'
        // Ini lebih efisien agar tidak terjadi N+1 query di view
        $jadwals = JadwalPosyandu::with('posyandu')->latest()->paginate(10);

        return view('pages.jadwal-posyandu.index', compact('jadwals'));
    }

    public function create()
    {
        // Ambil data posyandu untuk ditampilkan di dropdown
        $posyandus = Posyandu::orderBy('nama')->get();
        return view('pages.jadwal-posyandu.create', compact('posyandus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'tanggal' => 'required|date',
            'tema' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store($this->storagePath);
            $data['poster'] = basename($path);
        }

        JadwalPosyandu::create($data);

        return redirect()->route('jadwal-posyandu.index')
                         ->with('success', 'Data Jadwal Posyandu berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        // Tetap redirect ke index, meniru PosyanduController
        return redirect()->route('jadwal-posyandu.index');
    }

    public function edit(string $id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        $posyandus = Posyandu::orderBy('nama')->get(); // Data posyandu untuk dropdown
        return view('pages.jadwal-posyandu.edit', compact('jadwal', 'posyandus'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'tanggal' => 'required|date',
            'tema' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $jadwal = JadwalPosyandu::findOrFail($id);

        if ($request->hasFile('poster')) {
            // Hapus poster lama jika ada
            if ($jadwal->poster) {
                Storage::delete($this->storagePath . '/' . $jadwal->poster);
            }
            $path = $request->file('poster')->store($this->storagePath);
            $data['poster'] = basename($path);
        }

        $jadwal->update($data);

        return redirect()->route('jadwal-posyandu.index')
                         ->with('success', 'Data Jadwal Posyandu berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);

        // Hapus poster dari storage jika ada
        if ($jadwal->poster) {
            Storage::delete($this->storagePath . '/' . $jadwal->poster);
        }

        $jadwal->delete();

        return redirect()->route('jadwal-posyandu.index')
                         ->with('success', 'Data Jadwal Posyandu berhasil dihapus.');
    }
}