<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    /**
     * Menampilkan daftar semua warga dengan Search & Pagination.
     */
    public function index(Request $request)
    {
        // 1. Kolom yang bisa dicari (Search)
        $searchableColumns = ['nama', 'no_ktp', 'email', 'telp'];

        // 2. Kolom yang bisa difilter (TAMBAHKAN DISINI)
        // Kita akan memfilter berdasarkan Jenis Kelamin dan Agama
        $filterableColumns = ['jenis_kelamin', 'agama'];

        // 3. Query Data
        $warga = Warga::query()
            ->filter($request, $filterableColumns) // Fungsi filter berjalan disini
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pages.warga.index', compact('warga'));
    }

    // ... (Method create, store, edit, update, destroy biarkan tetap sama)
    // Pastikan method lain di bawah ini tidak terhapus

    public function create()
    {
        return view('pages.warga.create');
    }

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

    public function show(Warga $warga)
    {
        return redirect()->route('warga.index');
    }

    public function edit(Warga $warga)
    {
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $validatedData = $request->validate([
            'no_ktp'        => [
                'required', 'string', 'max:20',
                Rule::unique('warga')->ignore($warga->warga_id, 'warga_id'),
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

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
