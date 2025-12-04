<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PosyanduController extends Controller
{
    public function index(Request $request)
    {
        // Eager load relasi 'foto' agar query efisien
        $posyandus = Posyandu::with('foto')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            })
            ->orderBy('posyandu_id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.posyandu.index', compact('posyandus'));
    }

    public function create()
    {
        return view('pages.posyandu.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'            => 'required|string|max:100',
            'alamat'          => 'required|string',
            'rt'              => 'nullable|string|max:10',
            'rw'              => 'nullable|string|max:10',
            'kontak'          => 'nullable|string|max:100',
            'foto_profil'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Single File
            'galeri.*'        => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Multiple Files
        ]);

        // 1. Buat Data Posyandu
        $posyandu = Posyandu::create($data);

        // 2. Upload Foto Profil (Jika ada)
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $path = $file->store('uploads/posyandu/profil', 'public');

            // Simpan ke tabel Media via relasi morphOne
            $posyandu->foto()->create([
                'ref_table' => 'posyandu', // Redundant tapi aman
                'file_url'  => $path,
                'caption'   => 'foto_profil',
                'mime_type' => $file->getClientMimeType(),
            ]);
        }

        // 3. Upload Galeri (Jika ada)
        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $path = $file->store('uploads/posyandu/galeri', 'public');
                
                // Simpan ke tabel Media via relasi morphMany
                $posyandu->galeri()->create([
                    'ref_table' => 'posyandu',
                    'file_url'  => $path,
                    'caption'   => 'galeri',
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('posyandu.index')->with('success', 'Data Posyandu berhasil ditambahkan.');
    }

    public function show($id)
    {
        // Load foto profil dan galeri
        $posyandu = Posyandu::with(['foto', 'galeri'])->findOrFail($id);
        return view('pages.posyandu.show', compact('posyandu'));
    }

    public function edit($id)
    {
        $posyandu = Posyandu::with(['foto', 'galeri'])->findOrFail($id);
        return view('pages.posyandu.edit', compact('posyandu'));
    }

    public function update(Request $request, $id)
    {
        $posyandu = Posyandu::findOrFail($id);

        $data = $request->validate([
            'nama'            => 'required|string|max:100',
            'alamat'          => 'required|string',
            'rt'              => 'nullable|string|max:10',
            'rw'              => 'nullable|string|max:10',
            'kontak'          => 'nullable|string|max:100',
            'foto_profil'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'galeri.*'        => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $posyandu->update($data);

        // A. Handle Update Foto Profil
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($posyandu->foto) {
                Storage::disk('public')->delete($posyandu->foto->file_url);
                $posyandu->foto()->delete();
            }

            // Upload baru
            $file = $request->file('foto_profil');
            $path = $file->store('uploads/posyandu/profil', 'public');

            $posyandu->foto()->create([
                'ref_table' => 'posyandu',
                'file_url'  => $path,
                'caption'   => 'foto_profil',
                'mime_type' => $file->getClientMimeType(),
            ]);
        }

        // B. Handle Tambah Galeri (Append)
        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $path = $file->store('uploads/posyandu/galeri', 'public');
                $posyandu->galeri()->create([
                    'ref_table' => 'posyandu',
                    'file_url'  => $path,
                    'caption'   => 'galeri',
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('posyandu.index')->with('success', 'Data Posyandu diperbarui.');
    }

    public function destroy($id)
    {
        $posyandu = Posyandu::findOrFail($id);
        
        // Hapus fisik file foto profil
        if ($posyandu->foto) {
            Storage::disk('public')->delete($posyandu->foto->file_url);
        }

        // Hapus fisik file galeri
        foreach ($posyandu->galeri as $media) {
            Storage::disk('public')->delete($media->file_url);
        }

        // Hapus data (Relasi DB akan terhapus otomatis karena cascade di migration)
        $posyandu->delete();

        return redirect()->route('posyandu.index')->with('success', 'Data Posyandu dihapus.');
    }

    // Custom Function: Hapus 1 Foto Galeri via Edit Page
    public function deleteMedia($mediaId)
    {
        $media = Media::findOrFail($mediaId);
        
        // Hapus file fisik
        if (Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
        }
        
        $media->delete();

        return back()->with('success', 'Foto berhasil dihapus dari galeri.');
    }
}