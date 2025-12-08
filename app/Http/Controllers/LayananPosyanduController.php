<?php

namespace App\Http\Controllers;

use App\Models\LayananPosyandu;
use App\Models\JadwalPosyandu;
use App\Models\Warga;
use Illuminate\Http\Request;

class LayananPosyanduController extends Controller
{
    public function index(Request $request)
    {
        // Menghapus 'dokumentasi' dari with()
        $layanans = LayananPosyandu::with(['warga', 'jadwal'])
            ->search($request)
            ->orderBy('layanan_id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.layanan.index', compact('layanans'));
    }

    public function create()
    {
        $jadwals = JadwalPosyandu::with('posyandu')->orderBy('tanggal', 'desc')->get();
        $wargas = Warga::orderBy('nama', 'asc')->get();

        return view('pages.layanan.create', compact('jadwals', 'wargas'));
    }

    public function store(Request $request)
    {
        // Menghapus validasi dokumentasi
        $data = $request->validate([
            'jadwal_id'     => 'required|exists:jadwal_posyandu,jadwal_id',
            'warga_id'      => 'required|exists:warga,warga_id',
            'berat'         => 'required|numeric|min:0',
            'tinggi'        => 'required|numeric|min:0',
            'vitamin'       => 'nullable|string|max:100',
            'konseling'     => 'nullable|string',
        ]);

        // Simpan Data
        LayananPosyandu::create($data);

        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil disimpan.');
    }

    public function show($id)
    {
        // Menghapus 'dokumentasi' dari with()
        $layanan = LayananPosyandu::with(['warga', 'jadwal'])->findOrFail($id);
        return view('pages.layanan.show', compact('layanan'));
    }

    public function edit($id)
    {
        // Menghapus 'dokumentasi' dari with()
        $layanan = LayananPosyandu::findOrFail($id);
        $jadwals = JadwalPosyandu::with('posyandu')->orderBy('tanggal', 'desc')->get();
        $wargas = Warga::orderBy('nama', 'asc')->get();

        return view('pages.layanan.edit', compact('layanan', 'jadwals', 'wargas'));
    }

    public function update(Request $request, $id)
    {
        $layanan = LayananPosyandu::findOrFail($id);

        // Menghapus validasi dokumentasi
        $data = $request->validate([
            'jadwal_id'     => 'required|exists:jadwal_posyandu,jadwal_id',
            'warga_id'      => 'required|exists:warga,warga_id',
            'berat'         => 'required|numeric|min:0',
            'tinggi'        => 'required|numeric|min:0',
            'vitamin'       => 'nullable|string|max:100',
            'konseling'     => 'nullable|string',
        ]);

        $layanan->update($data);

        return redirect()->route('layanan.index')->with('success', 'Data layanan diperbarui.');
    }

    public function destroy($id)
    {
        $layanan = LayananPosyandu::findOrFail($id);
        // Menghapus logika penghapusan file fisik dari storage
        $layanan->delete();

        return redirect()->route('layanan.index')->with('success', 'Data dihapus.');
    }
}