<?php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use App\Models\Posyandu;
use Illuminate\Http\Request; // <-- Pastikan Request diimport
use Illuminate\Support\Facades\Storage;

class JadwalPosyanduController extends Controller
{
    private $storagePath = 'public/jadwal_posters';

    public function index(Request $request) // <-- Inject Request
    {
        // 1. Tentukan kolom lokal yang bisa dicari
        $searchableColumns = ['tema', 'keterangan'];
        
        // 2. Filter Columns (jika nanti butuh filter dropdown)
        $filterableColumns = [];

        // 3. Query Data dengan Filter, Search, dan Pagination
        $jadwals = JadwalPosyandu::with('posyandu')
            ->filter($request, $filterableColumns) // Panggil scopeFilter
            ->search($request, $searchableColumns) // Panggil scopeSearch
            ->orderBy('tanggal', 'desc')           // Urutkan tanggal terbaru
            ->paginate(10)                         // Pagination 10 per halaman
            ->withQueryString();                   // Agar parameter tidak hilang saat pindah halaman

        return view('pages.jadwal-posyandu.index', compact('jadwals'));
    }

    // ... (Method create, store, edit, update, destroy biarkan tetap sama) ...
    // Pastikan Anda tidak menghapus method lainnya.
    
    public function create()
    {
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
                         ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        $posyandus = Posyandu::orderBy('nama')->get();
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
        if ($jadwal->poster) {
            Storage::delete($this->storagePath . '/' . $jadwal->poster);
        }
        $jadwal->delete();
        return redirect()->route('jadwal-posyandu.index')
                         ->with('success', 'Data Jadwal Posyandu berhasil dihapus.');
    }
}