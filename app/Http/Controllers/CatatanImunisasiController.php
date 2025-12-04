<?php

namespace App\Http\Controllers;

use App\Models\CatatanImunisasi;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatatanImunisasiController extends Controller
{
    public function index(Request $request)
    {
        $imunisasi = CatatanImunisasi::with(['warga', 'dokumentasi'])
            ->search($request)
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.imunisasi.index', compact('imunisasi'));
    }

    public function create()
    {
        // Ambil data warga untuk dropdown
        $wargas = Warga::orderBy('nama', 'asc')->get();
        return view('pages.imunisasi.create', compact('wargas'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $data = $request->validate([
            'warga_id'      => 'required|exists:warga,warga_id',
            'jenis_vaksin'  => 'required|string|max:100',
            'tanggal'       => 'required|date',
            'lokasi'        => 'nullable|string|max:150',
            'nakes'         => 'nullable|string|max:100',
            'dokumentasi.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Multiple Image
        ]);

        // 2. Simpan Data Utama
        $imunisasi = CatatanImunisasi::create($data);

        // 3. Upload Dokumentasi (Looping)
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('uploads/imunisasi', 'public');
                
                $imunisasi->dokumentasi()->create([
                    'ref_table' => 'catatan_imunisasi',
                    'file_url'  => $path,
                    'caption'   => 'Dokumentasi Imunisasi',
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('imunisasi.index')->with('success', 'Catatan imunisasi berhasil disimpan.');
    }

    public function show($id)
    {
        $imunisasi = CatatanImunisasi::with(['warga', 'dokumentasi'])->findOrFail($id);
        return view('pages.imunisasi.show', compact('imunisasi'));
    }

    public function edit($id)
    {
        $imunisasi = CatatanImunisasi::with('dokumentasi')->findOrFail($id);
        $wargas = Warga::orderBy('nama', 'asc')->get();
        return view('pages.imunisasi.edit', compact('imunisasi', 'wargas'));
    }

    public function update(Request $request, $id)
    {
        $imunisasi = CatatanImunisasi::findOrFail($id);

        $data = $request->validate([
            'warga_id'      => 'required|exists:warga,warga_id',
            'jenis_vaksin'  => 'required|string|max:100',
            'tanggal'       => 'required|date',
            'lokasi'        => 'nullable|string|max:150',
            'nakes'         => 'nullable|string|max:100',
            'dokumentasi.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Update Text
        $imunisasi->update($data);

        // Tambah Dokumentasi Baru (Append)
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('uploads/imunisasi', 'public');
                
                $imunisasi->dokumentasi()->create([
                    'ref_table' => 'catatan_imunisasi',
                    'file_url'  => $path,
                    'caption'   => 'Dokumentasi Imunisasi',
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('imunisasi.index')->with('success', 'Catatan imunisasi diperbarui.');
    }

    public function destroy($id)
    {
        $imunisasi = CatatanImunisasi::findOrFail($id);

        // Hapus fisik file dokumentasi
        foreach ($imunisasi->dokumentasi as $media) {
            if (Storage::disk('public')->exists($media->file_url)) {
                Storage::disk('public')->delete($media->file_url);
            }
            $media->delete();
        }

        $imunisasi->delete();

        return redirect()->route('imunisasi.index')->with('success', 'Data berhasil dihapus.');
    }

    // Fungsi Hapus 1 Foto di halaman Edit
    public function deleteMedia($mediaId)
    {
        $media = Media::findOrFail($mediaId);
        
        if (Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
        }
        
        $media->delete();

        return back()->with('success', 'Foto dokumentasi dihapus.');
    }
}