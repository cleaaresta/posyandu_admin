<?php

namespace App\Http\Controllers;

use App\Models\KaderPosyandu;
use App\Models\Posyandu;
use App\Models\Warga;
use Illuminate\Http\Request;

class KaderPosyanduController extends Controller
{
    public function index(Request $request)
    {
        $kaders = KaderPosyandu::with(['warga', 'posyandu'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->whereHas('warga', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('no_ktp', 'like', "%{$search}%");
                })->orWhereHas('posyandu', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->orderBy('kader_id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.kader.index', compact('kaders'));
    }

    public function create()
    {
        $posyandus = Posyandu::orderBy('nama', 'asc')->get();
        // Ambil warga untuk dropdown
        $wargas = Warga::orderBy('nama', 'asc')->get();
        
        return view('pages.kader.create', compact('posyandus', 'wargas'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $data = $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'warga_id'    => 'required|exists:warga,warga_id|unique:kader_posyandu,warga_id',
            'peran'       => 'required|string|max:50',
            'mulai_tugas' => 'required|date',
            'akhir_tugas' => 'nullable|date|after_or_equal:mulai_tugas',
        ], [
            'warga_id.unique' => 'Warga ini sudah terdaftar sebagai kader aktif.',
            'warga_id.required' => 'Wajib memilih nama warga.',
        ]);

        // 2. Simpan
        KaderPosyandu::create($data);

        return redirect()->route('kader.index')->with('success', 'Data Kader berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kader = KaderPosyandu::with(['warga', 'posyandu'])->findOrFail($id);
        return view('pages.kader.show', compact('kader'));
    }

    public function edit($id)
    {
        $kader = KaderPosyandu::findOrFail($id);
        $posyandus = Posyandu::orderBy('nama', 'asc')->get();
        
        return view('pages.kader.edit', compact('kader', 'posyandus'));
    }

    public function update(Request $request, $id)
    {
        $kader = KaderPosyandu::findOrFail($id);

        $data = $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            // Validasi unique dikecualikan untuk ID ini sendiri
            'warga_id'    => 'required|exists:warga,warga_id|unique:kader_posyandu,warga_id,' . $id . ',kader_id',
            'peran'       => 'required|string|max:50',
            'mulai_tugas' => 'required|date',
            'akhir_tugas' => 'nullable|date|after_or_equal:mulai_tugas',
        ]);

        $kader->update($data);

        return redirect()->route('kader.index')->with('success', 'Data Kader diperbarui.');
    }

    public function destroy($id)
    {
        $kader = KaderPosyandu::findOrFail($id);
        $kader->delete();

        return redirect()->route('kader.index')->with('success', 'Data Kader berhasil dihapus.');
    }
}