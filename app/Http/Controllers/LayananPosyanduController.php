<?php

namespace App\Http\Controllers;

use App\Models\LayananPosyandu;
use App\Models\JadwalPosyandu;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananPosyanduController extends Controller
{
    public function index(Request $request)
    {
        $layanans = LayananPosyandu::with(['warga', 'jadwal', 'dokumentasi'])
            ->search($request)
            ->orderBy('layanan_id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.layanan.index', compact('layanans'));
    }

    public function create()
    {
        // Dropdown Jadwal (Yang terbaru dulu)
        $jadwals = JadwalPosyandu::with('posyandu')->orderBy('tanggal', 'desc')->get();
        // Dropdown Warga
        $wargas = Warga::orderBy('nama', 'asc')->get();

        return view('pages.layanan.create', compact('jadwals', 'wargas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jadwal_id'     => 'required|exists:jadwal_posyandu,jadwal_id',
            'warga_id'      => 'required|exists:warga,warga_id',
            'berat'         => 'required|numeric|min:0',
            'tinggi'        => 'required|numeric|min:0',
            'vitamin'       => 'nullable|string|max:100',
            'konseling'     => 'nullable|string',
            'dokumentasi.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Simpan Data
        $layanan = LayananPosyandu::create($data);

        // Upload Dokumentasi
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('uploads/layanan', 'public');
                
                $layanan->dokumentasi()->create([
                    'ref_table' => 'layanan_posyandu',
                    'file_url'  => $path,
                    'caption'   => 'Dokumentasi Layanan',
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil disimpan.');
    }

    public function show($id)
    {
        $layanan = LayananPosyandu::with(['warga', 'jadwal', 'dokumentasi'])->findOrFail($id);
        return view('pages.layanan.show', compact('layanan'));
    }

    public function edit($id)
    {
        $layanan = LayananPosyandu::with('dokumentasi')->findOrFail($id);
        $jadwals = JadwalPosyandu::with('posyandu')->orderBy('tanggal', 'desc')->get();
        $wargas = Warga::orderBy('nama', 'asc')->get();

        return view('pages.layanan.edit', compact('layanan', 'jadwals', 'wargas'));
    }

    public function update(Request $request, $id)
    {
        $layanan = LayananPosyandu::findOrFail($id);

        $data = $request->validate([
            'jadwal_id'     => 'required|exists:jadwal_posyandu,jadwal_id',
            'warga_id'      => 'required|exists:warga,warga_id',
            'berat'         => 'required|numeric|min:0',
            'tinggi'        => 'required|numeric|min:0',
            'vitamin'       => 'nullable|string|max:100',
            'konseling'     => 'nullable|string',
            'dokumentasi.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $layanan->update($data);

        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('uploads/layanan', 'public');
                $layanan->dokumentasi()->create([
                    'ref_table' => 'layanan_posyandu',
                    'file_url'  => $path,
                    'caption'   => 'Dokumentasi Layanan',
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('layanan.index')->with('success', 'Data layanan diperbarui.');
    }

    public function destroy($id)
    {
        $layanan = LayananPosyandu::findOrFail($id);

        foreach ($layanan->dokumentasi as $media) {
            if (Storage::disk('public')->exists($media->file_url)) {
                Storage::disk('public')->delete($media->file_url);
            }
            $media->delete();
        }

        $layanan->delete();

        return redirect()->route('layanan.index')->with('success', 'Data dihapus.');
    }

    public function deleteMedia($mediaId)
    {
        $media = Media::findOrFail($mediaId);
        if (Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
        }
        $media->delete();
        return back()->with('success', 'Foto dihapus.');
    }
}