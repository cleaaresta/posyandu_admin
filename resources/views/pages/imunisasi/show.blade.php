@extends('layouts.admin.app')

@section('title', 'Detail Imunisasi')
@section('page_title', 'Detail Riwayat Imunisasi')

@section('content')
    {{-- TOOLBAR ATAS --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        {{-- TOMBOL KEMBALI --}}
        <div>
            <a href="{{ route('imunisasi.index') }}" 
               class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 hover:text-slate-900 transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="flex gap-2">
            <a href="{{ route('imunisasi.edit', $imunisasi->imunisasi_id) }}" 
               class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>

            <form action="{{ route('imunisasi.destroy', $imunisasi->imunisasi_id) }}" method="POST" onsubmit="return confirm('Hapus data pemeriksaan ini?');">
                @csrf @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-red-600 to-orange-600 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                    <i class="fas fa-trash mr-2"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="flex flex-wrap -mx-3">
        {{-- KOLOM KIRI: FOTO & PROFIL SINGKAT --}}
        <div class="w-full lg:w-4/12 px-3 mb-6">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border h-full">
                <div class="p-6">
                    {{-- Foto Utama --}}
                    <div class="relative w-full overflow-hidden rounded-2xl shadow-lg mb-6 group aspect-[4/3]">
                        <img src="{{ $imunisasi->gambar_utama ?? asset('images/default-user.png') }}" 
                             alt="Foto Utama" 
                             class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>
                        <div class="absolute bottom-4 left-4">
                            <span class="px-3 py-1 text-xs font-bold text-white bg-blue-500 rounded-full shadow-sm">
                                {{ $imunisasi->jenis_vaksin ?? '-' }}
                            </span>
                        </div>
                    </div>

                    {{-- Data Warga --}}
                    <div class="text-center">
                        <h5 class="mb-1 text-xl font-bold text-slate-700 dark:text-white">
                            {{ $imunisasi->warga->nama ?? 'Warga Terhapus' }}
                        </h5>
                        <p class="text-sm text-slate-500 mb-6">
                            NIK: {{ $imunisasi->warga->no_ktp ?? ($imunisasi->warga->nik ?? '-') }}
                        </p>

                        {{-- Optional small stats (we keep simple/consistent with index) --}}
                        <div class="flex justify-center gap-3">
                            <div class="px-4 py-3 bg-slate-50 rounded-xl border border-slate-100 dark:bg-slate-700 dark:border-slate-600 w-1/2">
                                <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide">Jenis Kelamin</span>
                                <span class="text-lg font-bold text-slate-700 dark:text-white">
                                    @if(isset($imunisasi->warga->jenis_kelamin) && $imunisasi->warga->jenis_kelamin == 'Laki-laki')
                                        <i class="fas fa-mars text-blue-500"></i> L
                                    @elseif(isset($imunisasi->warga->jenis_kelamin))
                                        <i class="fas fa-venus text-pink-500"></i> P
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: DETAIL DATA (disesuaikan dg isi index/model) --}}
        <div class="w-full lg:w-8/12 px-3 mb-6">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border h-full">
                
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="font-bold text-slate-700 dark:text-white flex items-center text-lg">
                        <i class="fas fa-clipboard-list text-blue-500 mr-2 bg-blue-100 p-2 rounded-lg"></i> 
                        Rincian Imunisasi
                    </h6>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Tanggal Imunisasi --}}
                        <div class="flex items-start p-4 transition-all hover:bg-slate-50 rounded-xl border border-transparent hover:border-slate-100">
                            <div class="flex-shrink-0 mr-4">
                                <div class="flex items-center justify-center w-12 h-12 text-white bg-gradient-to-tl from-blue-500 to-cyan-400 rounded-xl shadow-md">
                                    <i class="far fa-calendar-check text-lg"></i>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Tanggal Imunisasi</p>
                                <h6 class="mb-0 font-bold text-slate-700 dark:text-white">
                                    {{ $imunisasi->tanggal ? \Carbon\Carbon::parse($imunisasi->tanggal)->translatedFormat('d F Y') : '-' }}
                                </h6>
                            </div>
                        </div>

                        {{-- Jenis Vaksin --}}
                        <div class="flex items-start p-4 transition-all hover:bg-slate-50 rounded-xl border border-transparent hover:border-slate-100">
                            <div class="flex-shrink-0 mr-4">
                                <div class="flex items-center justify-center w-12 h-12 text-white bg-gradient-to-tl from-emerald-500 to-teal-400 rounded-xl shadow-md">
                                    <i class="fas fa-syringe text-lg"></i>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Jenis Vaksin</p>
                                <h6 class="mb-0 font-bold text-slate-700 dark:text-white">
                                    {{ $imunisasi->jenis_vaksin ?? '-' }}
                                </h6>
                            </div>
                        </div>

                        {{-- Lokasi --}}
                        <div class="flex items-start p-4 transition-all hover:bg-slate-50 rounded-xl border border-transparent hover:border-slate-100">
                            <div class="flex-shrink-0 mr-4">
                                <div class="flex items-center justify-center w-12 h-12 text-white bg-gradient-to-tl from-orange-500 to-yellow-500 rounded-xl shadow-md">
                                    <i class="fas fa-map-marker-alt text-lg"></i>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Lokasi</p>
                                <h6 class="mb-0 font-bold text-slate-700 dark:text-white">
                                    {{ $imunisasi->lokasi ?? 'Posyandu Umum / Lainnya' }}
                                </h6>
                            </div>
                        </div>

                        {{-- Tenaga Kesehatan --}}
                        <div class="flex items-start p-4 transition-all hover:bg-slate-50 rounded-xl border border-transparent hover:border-slate-100">
                            <div class="flex-shrink-0 mr-4">
                                <div class="flex items-center justify-center w-12 h-12 text-white bg-gradient-to-tl from-red-600 to-rose-400 rounded-xl shadow-md">
                                    <i class="fas fa-user-nurse text-lg"></i>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Tenaga Kesehatan</p>
                                <h6 class="mb-0 font-bold text-slate-700 dark:text-white">
                                    {{ $imunisasi->nakes ?? '-' }}
                                </h6>
                            </div>
                        </div>

                        {{-- Catatan (opsional, tampilkan jika ada) --}}
                        @if(!empty($imunisasi->keterangan) || !empty($imunisasi->catatan))
                        <div class="col-span-1 md:col-span-2">
                            <div class="flex items-start p-4 bg-slate-50 rounded-xl border border-slate-100 dark:bg-slate-700/30 dark:border-slate-600">
                                <div class="flex-shrink-0 mr-4">
                                    <i class="fas fa-sticky-note text-slate-400 text-xl mt-1"></i>
                                </div>
                                <div>
                                    <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Catatan</p>
                                    <p class="mb-0 text-sm text-slate-600 dark:text-white leading-relaxed">
                                        {{ $imunisasi->keterangan ?? $imunisasi->catatan ?? 'Tidak ada catatan tambahan untuk riwayat ini.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        {{-- GALERI DOKUMENTASI (jika ada) --}}
        @if($imunisasi->dokumentasi && $imunisasi->dokumentasi->count() > 0)
        <div class="w-full px-3 mt-2">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6">
                    <h6 class="font-bold text-slate-700 dark:text-white mb-6 flex items-center">
                        <i class="fas fa-images text-purple-500 mr-2"></i> Galeri Dokumentasi
                    </h6>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach($imunisasi->dokumentasi as $foto)
                            <div class="relative group overflow-hidden rounded-xl shadow-md aspect-square cursor-pointer bg-slate-100">
                                <img src="{{ asset('storage/' . $foto->file_url) }}" 
                                     alt="Dokumentasi" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                
                                <a href="{{ asset('storage/' . $foto->file_url) }}" target="_blank"
                                   class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm">
                                    <div class="bg-white/20 p-3 rounded-full backdrop-blur-md">
                                        <i class="fas fa-search-plus text-white text-xl"></i>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
@endsection