@extends('layouts.admin.app')

@section('title', 'Detail Jadwal Posyandu')
@section('page_title', 'Detail Jadwal Posyandu')

@section('content')
    {{-- TOOLBAR ATAS --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        {{-- TOMBOL KEMBALI (Dibuat jadi tombol solid agar jelas) --}}
        <div>
            <a href="{{ route('jadwal-posyandu.index') }}" 
               class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 hover:text-slate-900 transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="flex gap-2">
            {{-- Edit: Biru Gradient (Mencolok sebagai aksi utama) --}}
            <a href="{{ route('jadwal-posyandu.edit', $jadwal->jadwal_id) }}" 
               class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>

            {{-- Hapus: Merah Gradient (Mencolok sebagai bahaya) --}}
            <form action="{{ route('jadwal-posyandu.destroy', $jadwal->jadwal_id) }}" method="POST" onsubmit="return confirm('Hapus data pemeriksaan ini?');">
                @csrf @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-red-600 to-orange-600 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                    <i class="fas fa-trash mr-2"></i> Hapus
                </button>
            </form>
        </div>
    </div>
    <div class="flex flex-wrap -mx-3">
        
        {{-- KOLOM KIRI: POSTER KEGIATAN --}}
        <div class="w-full lg:w-4/12 px-3 mb-6">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border h-full">
                <div class="p-6">
                    <h6 class="mb-4 font-bold text-slate-700 dark:text-white">Poster Kegiatan</h6>
                    
                    <div class="relative w-full overflow-hidden rounded-2xl shadow-lg group aspect-[3/4]">
                        <img src="{{ $jadwal->poster_url ?? asset('assets/img/default-poster.png') }}" 
                             alt="Poster" 
                             class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                        
                        {{-- Overlay Gradient --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6">
                            <a href="{{ $jadwal->poster_url ?? asset('assets/img/default-poster.png') }}" target="_blank" 
                               class="px-4 py-2 bg-white/20 backdrop-blur-md rounded-lg text-white font-bold text-sm hover:bg-white/40 transition-all">
                                <i class="fas fa-expand mr-2"></i> Lihat Full
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <span class="px-4 py-2 text-xs font-bold text-blue-500 bg-blue-100 rounded-full uppercase tracking-wide">
                            {{ $jadwal->posyandu->nama ?? 'Posyandu Umum' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: DETAIL INFORMASI --}}
        <div class="w-full lg:w-8/12 px-3 mb-6">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border h-full">
                
                {{-- Header Card --}}
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h5 class="font-bold text-slate-700 dark:text-white mb-1">
                        {{ $jadwal->tema }}
                    </h5>
                    <p class="text-sm text-slate-500 mb-4">Informasi lengkap mengenai jadwal kegiatan ini.</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Item 1: Tanggal --}}
                        <div class="flex items-start p-4 transition-all hover:bg-slate-50 rounded-xl border border-transparent hover:border-slate-100">
                            <div class="flex-shrink-0 mr-4">
                                <div class="flex items-center justify-center w-12 h-12 text-white bg-gradient-to-tl from-blue-500 to-cyan-400 rounded-xl shadow-md">
                                    <i class="far fa-calendar-alt text-lg"></i>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Tanggal Pelaksanaan</p>
                                <h6 class="mb-0 font-bold text-slate-700 dark:text-white">
                                    {{ $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') : '-' }}
                                </h6>
                            </div>
                        </div>

                        {{-- Item 2: Lokasi --}}
                        <div class="flex items-start p-4 transition-all hover:bg-slate-50 rounded-xl border border-transparent hover:border-slate-100">
                            <div class="flex-shrink-0 mr-4">
                                <div class="flex items-center justify-center w-12 h-12 text-white bg-gradient-to-tl from-orange-500 to-yellow-500 rounded-xl shadow-md">
                                    <i class="fas fa-map-marker-alt text-lg"></i>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Lokasi Posyandu</p>
                                <h6 class="mb-0 font-bold text-slate-700 dark:text-white">
                                    {{ $jadwal->posyandu->nama ?? '-' }}
                                </h6>
                                <p class="text-xs text-slate-500 mt-1">
                                    {{ Str::limit($jadwal->posyandu->alamat ?? '', 40) }}
                                </p>
                            </div>
                        </div>

                        {{-- Item 3: Keterangan (Full Width) --}}
                        <div class="col-span-1 md:col-span-2">
                            <div class="flex items-start p-5 bg-slate-50 rounded-xl border border-slate-100 dark:bg-slate-700/30 dark:border-slate-600">
                                <div class="flex-shrink-0 mr-4">
                                    <i class="fas fa-align-left text-slate-400 text-xl mt-1"></i>
                                </div>
                                <div class="w-full">
                                    <p class="mb-2 text-xs font-bold text-slate-400 uppercase">Deskripsi / Keterangan</p>
                                    <p class="mb-0 text-sm text-slate-600 dark:text-white leading-relaxed text-justify">
                                        {{ $jadwal->keterangan ?? 'Tidak ada keterangan tambahan untuk kegiatan ini.' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection