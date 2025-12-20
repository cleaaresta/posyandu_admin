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
        // Eager load 'poster' agar tidak lemot (N+1 Problem)
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
        // 1. Validasi Input
        $data = $request->validate([
            'posyandu_id' => 'required|exists:posyandu,posyandu_id',
            'tanggal'     => 'required|date',
            'tema'        => 'required|string|max:255',
            'keterangan'  => 'nullable|string',
            'poster'      => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        try {
            DB::beginTransaction();

            // 2. Simpan Data Utama
            $jadwal = JadwalPosyandu::create($data);

            // 3. Simpan File Poster jika ada
            if ($request->hasFile('poster')) {
                $file = $request->file('poster');
                $path = $file->store('uploads/jadwal', 'public');

                // Gunakan relasi hasOne yang mengarah ke ref_id
                $jadwal->poster()->create([
                    'ref_table' => 'jadwal_posyandu',
                    'ref_id'    => $jadwal->jadwal_id, // Primary key model Anda
                    'file_url'  => $path,
                    'caption'   => 'Poster ' . $jadwal->tema,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }

            DB::commit();
            return redirect()->route('jadwal-posyandu.index')->with('success', 'Jadwal berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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

            // 1. Update Data Teks
            $jadwal->update($data);

            // 2. Update Poster jika user mengunggah file baru
            if ($request->hasFile('poster')) {
                // Hapus poster lama dari storage & database
                if ($jadwal->poster) {
                    if (Storage::disk('public')->exists($jadwal->poster->file_url)) {
                        Storage::disk('public')->delete($jadwal->poster->file_url);
                    }
                    $jadwal->poster()->delete();
                }

                // Simpan poster baru
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
            return redirect()->route('jadwal-posyandu.index')->with('success', 'Jadwal berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);

        try {
            // Hapus file fisik dari folder storage
            if ($jadwal->poster) {
                if (Storage::disk('public')->exists($jadwal->poster->file_url)) {
                    Storage::disk('public')->delete($jadwal->poster->file_url);
                }
                $jadwal->poster()->delete();
            }

            $jadwal->delete();
            return redirect()->route('jadwal-posyandu.index')->with('success', 'Jadwal berhasil dihapus.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data.');
        }
    }
}