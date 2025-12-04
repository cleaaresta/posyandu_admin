@extends('layouts.admin.app')

@section('title', 'Detail Kader')
@section('page_title', 'Detail Kader Posyandu')

@section('content')
    {{-- TOOLBAR ATAS (Tidak ada perubahan) --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        {{-- TOMBOL KEMBALI --}}
        <div>
            <a href="{{ route('kader.index') }}" 
               class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 hover:text-slate-900 transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
        {{-- TOMBOL AKSI --}}
        <div class="flex gap-2">
            <a href="{{ route('kader.edit', $kader->kader_id) }}" 
               class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>
            <form action="{{ route('kader.destroy', $kader->kader_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data Kader bernama {{ $kader->warga?->nama ?? 'ini' }}?');">
                @csrf @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-red-600 to-orange-600 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                    <i class="fas fa-trash mr-2"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    {{-- PERBAIKAN UTAMA: Tambahkan 'flex' dan 'flex-wrap' pada container utama --}}
    <div class="flex flex-wrap -mx-3">
        
        {{-- KOLOM KIRI: FOTO PROFIL (w-full adalah default untuk mobile) --}}
        <div class="w-full lg:w-4/12 px-3 mb-6">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border h-full">
                {{-- ... (Isi Kolom Kiri) ... --}}
                <div class="p-6">
                    {{-- Foto Profil --}}
                    {{-- ... (Logika Foto Profil) ... --}}
                    @php
                        $wargaNama = $kader->warga?->nama ?? 'Kader';
                        $avatarUrl = $kader->warga?->foto_url 
                                     ? $kader->warga?->foto_url 
                                     : 'https://ui-avatars.com/api/?name=' . urlencode($wargaNama) . '&background=random&color=fff';
                    @endphp
                    <div class="relative w-full overflow-hidden rounded-2xl shadow-lg mb-6 group aspect-square mx-auto max-w-[300px]">
                        <img src="{{ $avatarUrl }}" 
                             alt="Foto Kader" 
                             class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                    </div>
                    {{-- Nama & Peran --}}
                    <div class="text-center">
                        <h5 class="mb-1 text-xl font-bold text-slate-700 dark:text-white">{{ $kader->warga?->nama ?? '-' }}</h5>
                        <p class="text-sm font-semibold text-blue-500 uppercase tracking-wide mb-6">
                            {{ $kader->peran ?? 'Kader Posyandu' }}
                        </p>
                        {{-- Stats --}}
                        <div class="px-4 py-3 bg-slate-50 rounded-xl border border-slate-100 dark:bg-slate-700 dark:border-slate-600">
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Mulai Bertugas</span>
                            <span class="text-md font-bold text-slate-700 dark:text-white">
                                <i class="far fa-calendar-alt mr-1"></i>
                                {{ $kader->mulai_tugas ? \Carbon\Carbon::parse($kader->mulai_tugas)->translatedFormat('d F Y') : '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: BIODATA & KONTAK --}}
        <div class="w-full lg:w-8/12 px-3 mb-6">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border h-full">
                {{-- ... (Isi Kolom Kanan) ... --}}
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="font-bold text-slate-700 dark:text-white flex items-center text-lg">
                        <i class="fas fa-id-card text-blue-500 mr-2 bg-blue-100 p-2 rounded-lg"></i> 
                        Biodata & Informasi
                    </h6>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- NIK --}}
                        <div class="flex items-start p-4 transition-all hover:bg-slate-50 rounded-xl border border-transparent hover:border-slate-100">
                            <div class="flex-shrink-0 mr-4">
                                <div class="flex items-center justify-center w-12 h-12 text-white bg-gradient-to-tl from-slate-600 to-slate-300 rounded-xl shadow-md">
                                    <i class="fas fa-id-badge text-lg"></i>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-bold text-slate-400 uppercase">NIK (Nomor Induk Kependudukan)</p>
                                <h6 class="mb-0 font-bold text-slate-700 dark:text-white">
                                    {{ $kader->warga?->no_ktp ?? '-' }}
                                </h6>
                            </div>
                        </div>

                        {{-- Posyandu --}}
                        <div class="flex items-start p-4 transition-all hover:bg-slate-50 rounded-xl border border-transparent hover:border-slate-100">
                            <div class="flex-shrink-0 mr-4">
                                <div class="flex items-center justify-center w-12 h-12 text-white bg-gradient-to-tl from-orange-500 to-yellow-500 rounded-xl shadow-md">
                                    <i class="fas fa-hospital-user text-lg"></i>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Asal Posyandu</p>
                                <h6 class="mb-0 font-bold text-slate-700 dark:text-white">
                                    {{ $kader->posyandu?->nama ?? '-' }}
                                </h6>
                                <p class="text-xs text-slate-500">{{ Str::limit($kader->posyandu?->alamat ?? '', 30) }}</p>
                            </div>
                        </div>

                        {{-- Kontak HP --}}
                        <div class="flex items-start p-4 transition-all hover:bg-slate-50 rounded-xl border border-transparent hover:border-slate-100">
                            <div class="flex-shrink-0 mr-4">
                                <div class="flex items-center justify-center w-12 h-12 text-white bg-gradient-to-tl from-green-600 to-lime-400 rounded-xl shadow-md">
                                    <i class="fab fa-whatsapp text-lg"></i>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Nomor HP / WhatsApp</p>
                                <h6 class="mb-0 font-bold text-slate-700 dark:text-white">
                                    {{ $kader->warga?->telp ?? '-' }}
                                </h6>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="flex items-start p-4 transition-all hover:bg-slate-50 rounded-xl border border-transparent hover:border-slate-100">
                            <div class="flex-shrink-0 mr-4">
                                <div class="flex items-center justify-center w-12 h-12 text-white bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-xl shadow-md">
                                    <i class="fas fa-envelope text-lg"></i>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Alamat Email</p>
                                <h6 class="mb-0 font-bold text-slate-700 dark:text-white">
                                    {{ $kader->warga?->email ?? '-' }}
                                </h6>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="col-span-1 md:col-span-2">
                            <div class="flex items-start p-4 bg-slate-50 rounded-xl border border-slate-100 dark:bg-slate-700/30 dark:border-slate-600">
                                <div class="flex-shrink-0 mr-4">
                                    <i class="fas fa-map-marked-alt text-slate-400 text-xl mt-1"></i>
                                </div>
                                <div class="w-full">
                                    <p class="mb-1 text-xs font-bold text-slate-400 uppercase">Alamat Lengkap</p>
                                    <p class="mb-0 text-sm text-slate-600 dark:text-white leading-relaxed">
                                        {{ $kader->warga?->alamat ?? 'Alamat tidak tersedia' }}
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