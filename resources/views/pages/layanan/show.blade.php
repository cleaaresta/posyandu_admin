@extends('layouts.admin.app')

@section('title', 'Detail Pemeriksaan & Layanan')
@section('page_title', 'Detail Pemeriksaan & Layanan')

@section('content')
    {{-- TOOLBAR ATAS --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <div>
            <a href="{{ route('layanan.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-700 bg-white border rounded-lg shadow-sm hover:bg-slate-50">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('layanan.edit', $layanan->layanan_id) }}" class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase rounded-lg bg-gradient-to-tl from-blue-600 to-cyan-400">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>

            <form action="{{ route('layanan.destroy', $layanan->layanan_id) }}" method="POST" onsubmit="return confirm('Hapus data pemeriksaan ini?');">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase rounded-lg bg-gradient-to-tl from-red-600 to-orange-600">
                    <i class="fas fa-trash mr-2"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="flex flex-wrap -mx-3">
        {{-- KOLOM KIRI: PROFIL WARGA --}}
        <div class="w-full lg:w-4/12 px-3 mb-6">
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <div class="relative w-full overflow-hidden rounded-2xl shadow-lg mb-6 group aspect-square mx-auto max-w-[280px]">
                    <img src="{{ $layanan->warga->foto_url ?? asset('assets/img/default-user.png') }}" alt="Foto Profil" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                </div>

                <div class="text-center">
                    <h5 class="mb-1 text-xl font-bold">{{ $layanan->warga->nama ?? '-' }}</h5>
                    <p class="text-sm text-slate-500 mb-4">Peserta Posyandu</p>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="px-4 py-3 bg-slate-50 rounded-xl border">
                            <span class="block text-xs font-bold text-slate-400 uppercase">NIK</span>
                            <span class="text-sm font-bold text-slate-700 truncate">{{ $layanan->warga->no_ktp ?? '-' }}</span>
                        </div>

                        <div class="px-4 py-3 bg-slate-50 rounded-xl border">
                            <span class="block text-xs font-bold text-slate-400 uppercase">Kontak</span>
                            <span class="text-sm font-bold text-slate-700">{{ $layanan->warga->telp ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: HASIL PEMERIKSAAN --}}
        <div class="w-full lg:w-8/12 px-3 mb-6">
            <div class="bg-white rounded-2xl shadow-xl">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        <h6 class="font-bold text-lg text-slate-700 flex items-center">
                            <i class="fas fa-heartbeat text-red-500 mr-2 bg-red-100 p-2 rounded-lg"></i> Hasil Pemeriksaan Kesehatan
                        </h6>
                        <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1 rounded-lg">
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ $layanan->jadwal && $layanan->jadwal->tanggal ? \Carbon\Carbon::parse($layanan->jadwal->tanggal)->translatedFormat('d F Y') : '-' }}
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-center p-4 bg-slate-50 rounded-xl border">
                            <div class="mr-4 w-12 h-12 flex items-center justify-center bg-gradient-to-tl from-blue-500 to-cyan-400 rounded-xl text-white">
                                <i class="fas fa-weight"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-xs font-bold text-slate-400 uppercase">Berat Badan</p>
                                <h4 class="mb-0 font-bold text-slate-700">{{ $layanan->berat }} <span class="text-sm text-slate-500">kg</span></h4>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-slate-50 rounded-xl border">
                            <div class="mr-4 w-12 h-12 flex items-center justify-center bg-gradient-to-tl from-emerald-500 to-teal-400 rounded-xl text-white">
                                <i class="fas fa-ruler-vertical"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-xs font-bold text-slate-400 uppercase">Tinggi Badan</p>
                                <h4 class="mb-0 font-bold text-slate-700">{{ $layanan->tinggi }} <span class="text-sm text-slate-500">cm</span></h4>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-slate-50 rounded-xl border">
                            <div class="mr-4 w-12 h-12 flex items-center justify-center bg-gradient-to-tl from-orange-500 to-yellow-500 rounded-xl text-white">
                                <i class="fas fa-pills"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-xs font-bold text-slate-400 uppercase">Vitamin / Obat</p>
                                <h4 class="mb-0 font-bold text-slate-700">{{ $layanan->vitamin ?? '-' }}</h4>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-slate-50 rounded-xl border">
                            <div class="mr-4 w-12 h-12 flex items-center justify-center bg-gradient-to-tl from-purple-600 to-fuchsia-400 rounded-xl text-white">
                                <i class="fas fa-comments"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-xs font-bold text-slate-400 uppercase">Konseling</p>
                                <h4 class="mb-0 font-bold text-slate-700">{{ $layanan->konseling ?? '-' }}</h4>
                            </div>
                        </div>

                        {{-- Catatan (full width) --}}
                        <div class="col-span-1 md:col-span-2">
                            <div class="p-5 bg-slate-50 rounded-xl border">
                                <p class="mb-2 text-xs font-bold text-slate-400 uppercase">Catatan / Keluhan</p>
                                <p class="mb-0 text-sm text-slate-600">{{ $layanan->konseling ?? 'Tidak ada catatan.' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Dokumentasi telah dihapus --}}
                </div>
            </div>
        </div>
    </div>
@endsection