<?php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use App\Models\Posyandu;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class JadwalPosyanduController extends Controller
{
    public function index(Request $request)
    {
        $jadwals = JadwalPosyandu::with(['posyandu', 'poster'])
            ->search($request)
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.jadwal-posyandu.index', compact('jadwals'));
    }

    public function create()
    {
        $posyandus = Posyandu::orderBy('nama')->get();
        return view('pages.jadwal-posyandu.create', compact('posyandus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'tanggal'     => 'required|date',
            'tema'        => 'required|string|max:255',
            'keterangan'  => 'nullable|string',
            'poster'      => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        try {
            DB::beginTransaction();

            // 1. Simpan Jadwal
            $jadwal = JadwalPosyandu::create($data);

            // 2. Simpan Poster (Pastikan menggunakan ID yang baru saja dibuat)
            if ($request->hasFile('poster')) {
                $file = $request->file('poster');
                $path = $file->store('uploads/jadwal', 'public');

                $jadwal->poster()->create([
                    'ref_table' => 'jadwal_posyandu',
                    'ref_id'    => $jadwal->jadwal_id, // Mengambil ID dari record baru
                    'file_url'  => $path,
                    'caption'   => 'Poster ' . $jadwal->tema,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }

            DB::commit();
            return redirect()->route('jadwal-posyandu.index')->with('success', 'Jadwal dan Poster berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $jadwal = JadwalPosyandu::with(['posyandu', 'poster'])->findOrFail($id);
        return view('pages.jadwal-posyandu.show', compact('jadwal'));
    }

    public function edit($id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        $posyandus = Posyandu::orderBy('nama')->get();
        return view('pages.jadwal-posyandu.edit', compact('jadwal', 'posyandus'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);

        $data = $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'tanggal'     => 'required|date',
            'tema'        => 'required|string|max:255',
            'keterangan'  => 'nullable|string',
            'poster'      => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        try {
            DB::beginTransaction();

            $jadwal->update($data);

            if ($request->hasFile('poster')) {
                // Hapus file fisik dan record lama
                if ($jadwal->poster) {
                    Storage::disk('public')->delete($jadwal->poster->file_url);
                    $jadwal->poster()->delete();
                }

                // Upload baru
                $file = $request->file('poster');
                $path = $file->store('uploads/jadwal', 'public');

                $jadwal->poster()->create([
                    'ref_table' => 'jadwal_posyandu',
                    'ref_id'    => $jadwal->jadwal_id,
                    'file_url'  => $path,
                    'caption'   => 'Poster ' . $jadwal->tema,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }

            DB::commit();
            return redirect()->route('jadwal-posyandu.index')->with('success', 'Data berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        if ($jadwal->poster) {
            Storage::disk('public')->delete($jadwal->poster->file_url);
            $jadwal->poster()->delete();
        }
        $jadwal->delete();
        return redirect()->route('jadwal-posyandu.index')->with('success', 'Data dihapus.');
    }
}