<?php

namespace App\Http\Controllers;

use App\Models\Posyandu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PosyanduController extends Controller
{
    public function index()
    {
        // --- Gunakan paginate() BUKAN all() ---
        $posyandus = Posyandu::paginate(10);

        return view('admin1.posyandu.index', compact('posyandus'));
    }

    public function create()
    {
        return view('admin1.posyandu.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'kontak' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/posyandu_fotos');
            $data['foto'] = basename($path);
        }

        Posyandu::create($data);

        return redirect()->route('posyandu.index')
                         ->with('success', 'Data Posyandu berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        return redirect()->route('posyandu.index');
    }

    public function edit(string $id)
    {
        $posyandu = Posyandu::findOrFail($id);
        return view('admin1.posyandu.edit', compact('posyandu'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'kontak' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $posyandu = Posyandu::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($posyandu->foto) {
                Storage::delete('public/posyandu_fotos/' . $posyandu->foto);
            }
            $path = $request->file('foto')->store('public/posyandu_fotos');
            $data['foto'] = basename($path);
        }

        $posyandu->update($data);

        return redirect()->route('posyandu.index')
                         ->with('success', 'Data Posyandu berhasil diperbarui.');
    }

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
