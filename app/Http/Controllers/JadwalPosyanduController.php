<?php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use App\Models\Posyandu;
use App\Models\Media; // Jangan lupa import ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JadwalPosyanduController extends Controller
{
    public function index(Request $request)
    {
        $jadwals = JadwalPosyandu::with(['posyandu', 'poster']) // Eager load poster
            ->search($request)
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.jadwal-posyandu.index', compact('jadwals'));
    }

    public function create()
    {
        $posyandus = Posyandu::orderBy('nama')->get();
        return view('pages.jadwal-posyandu.create', compact('posyandus'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $data = $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'tanggal'     => 'required|date',
            'tema'        => 'required|string|max:255',
            'keterangan'  => 'nullable|string',
            'poster'      => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Validasi file
        ]);

        // 2. Buat Jadwal
        $jadwal = JadwalPosyandu::create($data);

        // 3. Upload Poster (Jika ada)
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $path = $file->store('uploads/jadwal', 'public');

            // Simpan ke tabel Media
            $jadwal->poster()->create([
                'ref_table' => 'jadwal_posyandu', // Redundant tapi aman
                'file_url'  => $path,
                'caption'   => 'Poster ' . $jadwal->tema,
                'mime_type' => $file->getClientMimeType(),
            ]);
        }

        return redirect()->route('jadwal-posyandu.index')->with('success', 'Jadwal berhasil dibuat.');
    }

    public function show($id)
    {
        $jadwal = JadwalPosyandu::with(['posyandu', 'poster'])->findOrFail($id);
        return view('pages.jadwal-posyandu.show', compact('jadwal'));
    }

    public function edit($id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        $posyandus = Posyandu::orderBy('nama')->get();
        return view('pages.jadwal-posyandu.edit', compact('jadwal', 'posyandus'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);

        $data = $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'tanggal'     => 'required|date',
            'tema'        => 'required|string|max:255',
            'keterangan'  => 'nullable|string',
            'poster'      => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Update Text
        $jadwal->update($data);

        // Update Poster (Jika upload baru)
        if ($request->hasFile('poster')) {
            // Hapus lama
            if ($jadwal->poster) {
                if(Storage::disk('public')->exists($jadwal->poster->file_url)) {
                    Storage::disk('public')->delete($jadwal->poster->file_url);
                }
                $jadwal->poster()->delete();
            }

            // Upload baru
            $file = $request->file('poster');
            $path = $file->store('uploads/jadwal', 'public');

            $jadwal->poster()->create([
                'ref_table' => 'jadwal_posyandu',
                'file_url'  => $path,
                'caption'   => 'Poster ' . $jadwal->tema,
                'mime_type' => $file->getClientMimeType(),
            ]);
        }

        return redirect()->route('jadwal-posyandu.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);

        // Hapus fisik poster
        if ($jadwal->poster) {
            Storage::disk('public')->delete($jadwal->poster->file_url);
            // Record media terhapus otomatis via cascade (jika di-set) atau bisa manual:
            $jadwal->poster()->delete();
        }

        $jadwal->delete();

        return redirect()->route('jadwal-posyandu.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}