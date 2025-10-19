<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    /**
     * Menampilkan daftar semua warga.
     */
    public function index()
    {
        $warga = Warga::latest()->paginate(10);

        // PERBAIKAN: Path view menunjuk ke admin1.warga.index
        return view('admin1.warga.index', compact('warga'));
    }

    /**
     * Menampilkan form untuk membuat warga baru.
     */
    public function create()
    {
        // PERBAIKAN: Path view menunjuk ke admin1.warga.create
        return view('admin1.warga.create');
    }

    /**
     * Menyimpan data warga baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_ktp'        => 'required|string|max:20|unique:warga,no_ktp',
            'nama'          => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama'         => 'nullable|string|max:50',
            'pekerjaan'     => 'nullable|string|max:100',
            'telp'          => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:100',
        ]);

        Warga::create($validatedData);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu warga.
     */
    public function show(Warga $warga)
    {
        // PERBAIKAN: Path view menunjuk ke admin1.warga.show (jika Anda membuatnya)
        // Jika tidak ada file show.blade.php, Anda bisa hapus fungsi ini.
        return view('admin1.warga.show', compact('warga'));
    }

    /**
     * Menampilkan form untuk mengedit data warga.
     */
    public function edit(Warga $warga)
    {
        // PERBAIKAN: Path view menunjuk ke admin1.warga.edit
        return view('admin1.warga.edit', compact('warga'));
    }

    /**
     * Memperbarui data warga di database.
     */
    public function update(Request $request, Warga $warga)
    {
        $validatedData = $request->validate([
            'no_ktp'        => [
                'required', 'string', 'max:20',
                Rule::unique('warga')->ignore($warga->warga_id, 'warga_id')
            ],
            'nama'          => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama'         => 'nullable|string|max:50',
            'pekerjaan'     => 'nullable|string|max:100',
            'telp'          => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:100',
        ]);

        $warga->update($validatedData);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Menghapus data warga dari database.
     */
    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
