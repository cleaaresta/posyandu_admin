<?php

namespace App\Http\Controllers;

use App\Models\Posyandu; // <-- PASTIKAN INI ADA
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- PASTIKAN INI ADA

class PosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posyandus = Posyandu::all();
        return view('admin1.posyandu.index', compact('posyandus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin1.posyandu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'kontak' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Handle upload file
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/posyandu_fotos');
            $data['foto'] = basename($path);
        }

        // 3. Simpan (Kode ini aman dari MassAssignment)
        Posyandu::create($data);

        return redirect()->route('posyandu.index')
                         ->with('success', 'Data Posyandu berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('posyandu.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posyandu = Posyandu::findOrFail($id);
        return view('admin1.posyandu.edit', compact('posyandu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validasi data (INI PERBAIKANNYA)
        // $data HANYA akan berisi field yang tervalidasi.
        // posyandu_id TIDAK ADA di sini, jadi aman.
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'kontak' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Cari record yang akan di-update
        $posyandu = Posyandu::findOrFail($id);

        // 3. Handle file foto baru (jika ada)
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($posyandu->foto) {
                Storage::delete('public/posyandu_fotos/' . $posyandu->foto);
            }
            // Simpan foto baru
            $path = $request->file('foto')->store('public/posyandu_fotos');
            $data['foto'] = basename($path);
        }

        // 4. Update data (Kode ini aman dari MassAssignment)
        $posyandu->update($data);

        return redirect()->route('posyandu.index')
                         ->with('success', 'Data Posyandu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $posyandu = Posyandu::findOrFail($id);

        if ($posyandu->foto) {
            Storage::delete('public/posyandu_fotos/' . $posyandu->foto);
        }

        $posyandu->delete();

        return redirect()->route('posyandu.index')
                         ->with('success', 'Data Posyandu berhasil dihapus.');
    }
}
