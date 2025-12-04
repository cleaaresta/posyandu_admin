@extends('layouts.admin.app')

@section('title', 'Detail Posyandu')
@section('page_title', 'Detail Posyandu')

@section('content')
    {{-- TOOLBAR --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        {{-- TOMBOL KEMBALI (Dibuat jadi tombol solid agar jelas) --}}
        <div>
            <a href="{{ route('posyandu.index') }}" 
               class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 hover:text-slate-900 transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="flex gap-2">
            {{-- Edit: Biru Gradient (Mencolok sebagai aksi utama) --}}
            <a href="{{ route('posyandu.edit', $posyandu->posyandu_id) }}" 
               class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>

            {{-- Hapus: Merah Gradient (Mencolok sebagai bahaya) --}}
            <form action="{{ route('posyandu.destroy', $posyandu->posyandu_id) }}" method="POST" onsubmit="return confirm('Hapus data posyandu ini beserta isinya?');">
                @csrf @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-red-600 to-orange-600 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                    <i class="fas fa-trash mr-2"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="flex flex-wrap -mx-3">
        
        {{-- KOLOM KIRI: FOTO UTAMA --}}
        <div class="w-full lg:w-5/12 px-3 mb-6">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border h-full">
                <div class="p-6">
                    {{-- Foto Posyandu --}}
                    <div class="relative w-full overflow-hidden rounded-2xl shadow-lg mb-6 group aspect-video">
                        @php
                            $namaPos = $posyandu->nama ?? 'Posyandu';
                            $hasFoto = isset($posyandu->foto) && $posyandu->foto;
                            $fotoUrl = $hasFoto ? $posyandu->foto_url : null;
                            $avatar = $fotoUrl
                                ? $fotoUrl
                                : 'https://ui-avatars.com/api/?name=' . urlencode($namaPos) . '&background=random&color=fff';
                        @endphp
                        <img src="{{ $avatar }}" 
                             alt="Foto Posyandu" 
                             class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                    </div>

                    {{-- Nama & Status --}}
                    <div class="text-center">
                        <h4 class="mb-1 font-bold text-slate-700 dark:text-white">{{ $posyandu->nama }}</h4>
                        <span class="px-3 py-1 text-xs font-bold text-blue-500 bg-blue-100 rounded-full uppercase tracking-wide">
                            Posyandu Aktif
                        </span>
                        
                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-center">
                                <i class="fas fa-users text-blue-500 text-2xl mb-2"></i>
                                <span class="block text-xs text-slate-400 font-bold uppercase">Kader</span>
                                <span class="font-bold text-lg text-slate-700">{{ $posyandu->kader_count ?? 0 }}</span>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-center">
                                <i class="fas fa-baby text-pink-500 text-2xl mb-2"></i>
                                <span class="block text-xs text-slate-400 font-bold uppercase">Balita</span>
                                <span class="font-bold text-lg text-slate-700">{{ $posyandu->warga_count ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: DETAIL LOKASI & KONTAK --}}
        <div class="w-full lg:w-7/12 px-3 mb-6">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border h-full">
                
                {{-- Header --}}
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="font-bold text-slate-700 dark:text-white flex items-center text-lg">
                        <i class="fas fa-map-marked-alt text-blue-500 mr-2 bg-blue-100 p-2 rounded-lg"></i> 
                        Informasi Lokasi & Kontak
                    </h6>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 gap-6">
                        
                        {{-- Alamat --}}
                        <div class="flex items-start p-4 bg-slate-50 rounded-xl border border-slate-100 dark:bg-slate-700/30">
                            <div class="flex-shrink-0 mr-4 mt-1">
                                <i class="fas fa-home text-slate-400 text-xl"></i>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Alamat Lengkap</p>
                                <h6 class="mb-1 font-bold text-slate-700 dark:text-white text-lg">
                                    {{ $posyandu->alamat }}
                                </h6>
                                <div class="flex gap-2">
                                    <span class="px-2 py-1 text-xs font-bold bg-white border rounded text-slate-600">RT {{ $posyandu->rt }}</span>
                                    <span class="px-2 py-1 text-xs font-bold bg-white border rounded text-slate-600">RW {{ $posyandu->rw }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Wilayah --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-start p-4 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="flex-shrink-0 mr-3">
                                    <i class="fas fa-map text-orange-400 text-lg"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-xs font-bold text-slate-400 uppercase">Kelurahan / Desa</p>
                                    <h6 class="mb-0 font-bold text-slate-700">{{ $posyandu->kelurahan ?? '-' }}</h6>
                                </div>
                            </div>
                            <div class="flex items-start p-4 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="flex-shrink-0 mr-3">
                                    <i class="fas fa-city text-purple-400 text-lg"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-xs font-bold text-slate-400 uppercase">Kecamatan</p>
                                    <h6 class="mb-0 font-bold text-slate-700">{{ $posyandu->kecamatan ?? '-' }}</h6>
                                </div>
                            </div>
                        </div>

                        {{-- Kontak --}}
                        <div class="flex items-start p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="flex-shrink-0 mr-4 mt-1">
                                <div class="flex items-center justify-center w-10 h-10 text-white bg-green-500 rounded-lg shadow-md">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Kontak Pengurus</p>
                                <h6 class="mb-0 font-bold text-slate-700 dark:text-white text-lg">
                                    {{ $posyandu->kontak ?? '-' }}
                                </h6>
                                <p class="text-xs text-slate-500 italic">Dapat dihubungi untuk informasi jadwal</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection