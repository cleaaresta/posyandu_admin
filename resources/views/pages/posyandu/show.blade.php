@extends('layouts.admin.app')

@section('title', 'Detail Posyandu')
@section('page_title', 'Detail Data Posyandu')

@section('content')
    {{-- WRAPPER UTAMA --}}
    <div class="w-full px-6 py-6 mx-auto">

        {{-- TOOLBAR ATAS (Tombol Kembali & Aksi) --}}
        <div class="flex flex-wrap justify-between items-center mb-8">
            {{-- Tombol Kembali --}}
            <a href="{{ route('posyandu.index') }}" 
               class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-xl shadow-sm hover:bg-slate-50 hover:text-slate-900 transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>

            {{-- Group Tombol Aksi --}}
            <div class="flex gap-3">
                <a href="{{ route('posyandu.edit', $posyandu->posyandu_id) }}" 
                   class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-500 to-violet-500 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>

                <form action="{{ route('posyandu.destroy', $posyandu->posyandu_id) }}" method="POST" onsubmit="return confirm('Hapus data posyandu ini beserta isinya?');">
                    @csrf @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-red-600 to-orange-600 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px">
                        <i class="fas fa-trash mr-2"></i> Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="flex flex-wrap -mx-3">
            
            {{-- KOLOM KIRI: KARTU PROFIL & STATISTIK (Lebar 4/12 atau 1/3) --}}
            <div class="w-full lg:w-4/12 px-3 mb-6">
                <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 rounded-2xl bg-clip-border">
                    
                    {{-- Banner Gradient Kecil di Atas Kartu --}}
                    <div class="h-24 rounded-t-2xl bg-gradient-to-tl from-blue-500 to-violet-500 opacity-80"></div>

                    <div class="flex flex-col items-center pb-6 px-6 -mt-16">
                        {{-- Foto Profil (Dibatasi ukurannya agar rapi) --}}
                        <div class="relative w-32 h-32 mb-4 bg-white p-1 rounded-2xl shadow-lg">
                            @php
                                $namaPos = $posyandu->nama ?? 'Posyandu';
                                $hasFoto = isset($posyandu->foto) && $posyandu->foto;
                                $fotoUrl = $hasFoto ? $posyandu->foto_url : null;
                                // Fallback avatar jika tidak ada foto
                                $avatar = $fotoUrl ? $fotoUrl : 'https://ui-avatars.com/api/?name=' . urlencode($namaPos) . '&background=random&color=fff&size=256';
                            @endphp
                            <img src="{{ $avatar }}" 
                                 alt="Foto Posyandu" 
                                 class="w-full h-full object-cover rounded-xl border border-slate-100">
                        </div>

                        {{-- Nama & Status --}}
                        <h5 class="mb-1 text-xl font-bold text-slate-700 dark:text-white text-center">
                            {{ $posyandu->nama }}
                        </h5>
                        <div class="mb-6">
                            <span class="px-3 py-1 text-xs font-bold text-emerald-500 bg-emerald-100 rounded-full uppercase border border-emerald-200">
                                <i class="fas fa-check-circle mr-1"></i> Aktif
                            </span>
                        </div>

                        {{-- Statistik Grid (Kader & Balita) --}}
                        <div class="flex justify-center w-full gap-4 mb-6">
                            {{-- Stats Kader --}}
                            <div class="flex-1 p-3 text-center border rounded-xl bg-slate-50 border-slate-100">
                                <div class="text-blue-500 text-lg mb-1"><i class="fas fa-users"></i></div>
                                <span class="block text-xl font-bold text-slate-700">{{ $posyandu->kader_count ?? 0 }}</span>
                                <span class="text-xs text-slate-400 font-bold uppercase">Kader</span>
                            </div>
                            
                            {{-- Stats Balita --}}
                            <div class="flex-1 p-3 text-center border rounded-xl bg-slate-50 border-slate-100">
                                <div class="text-pink-500 text-lg mb-1"><i class="fas fa-baby"></i></div>
                                <span class="block text-xl font-bold text-slate-700">{{ $posyandu->warga_count ?? 0 }}</span>
                                <span class="text-xs text-slate-400 font-bold uppercase">Balita</span>
                            </div>
                        </div>

                        {{-- Kontak Info --}}
                        <div class="w-full">
                            <h6 class="text-xs font-bold text-slate-400 uppercase mb-3 text-center">Kontak Pengurus</h6>
                            <div class="flex items-center p-3 transition-all rounded-lg bg-slate-50 hover:bg-slate-100 border border-slate-100">
                                <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-lg bg-green-500 text-white shadow-md">
                                    <i class="fab fa-whatsapp text-lg"></i>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h6 class="mb-0 text-sm font-semibold leading-normal text-slate-700">WhatsApp / Telp</h6>
                                    <p class="mb-0 text-xs leading-tight text-slate-500">
                                        {{ $posyandu->kontak ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: DETAIL INFORMASI (Lebar 8/12 atau 2/3) --}}
            <div class="w-full lg:w-8/12 px-3 mb-6">
                <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 rounded-2xl bg-clip-border">
                    
                    <div class="p-6 pb-0 mb-0 border-b-0 rounded-t-2xl">
                        <div class="flex items-center justify-between">
                            <h6 class="mb-0 font-bold text-slate-700 flex items-center">
                                <i class="fas fa-map-marked-alt text-blue-500 mr-2 bg-blue-50 p-2 rounded-lg"></i>
                                Detail Lokasi & Wilayah
                            </h6>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- Alamat Lengkap (Full Width) --}}
                            <div class="md:col-span-2">
                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                                    <p class="text-xs font-bold text-slate-400 uppercase mb-2">Alamat Lengkap</p>
                                    <div class="flex items-start">
                                        <i class="fas fa-map-pin text-red-500 mt-1 mr-3"></i>
                                        <p class="text-sm font-semibold text-slate-700 leading-relaxed">
                                            {{ $posyandu->alamat }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Item: RT/RW --}}
                            <div class="flex p-4 rounded-xl border border-slate-100 hover:shadow-sm transition-shadow">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center">
                                        <i class="fas fa-home"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase mb-1">RT / RW</p>
                                    <h6 class="font-bold text-slate-700 text-sm">
                                        RT {{ $posyandu->rt }} / RW {{ $posyandu->rw }}
                                    </h6>
                                </div>
                            </div>

                            {{-- Item: Kelurahan --}}
                            <div class="flex p-4 rounded-xl border border-slate-100 hover:shadow-sm transition-shadow">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-500 flex items-center justify-center">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase mb-1">Kelurahan / Desa</p>
                                    <h6 class="font-bold text-slate-700 text-sm">
                                        {{ $posyandu->kelurahan ?? '-' }}
                                    </h6>
                                </div>
                            </div>

                            {{-- Item: Kecamatan --}}
                            <div class="flex p-4 rounded-xl border border-slate-100 hover:shadow-sm transition-shadow">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="w-10 h-10 rounded-full bg-cyan-100 text-cyan-500 flex items-center justify-center">
                                        <i class="fas fa-city"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase mb-1">Kecamatan</p>
                                    <h6 class="font-bold text-slate-700 text-sm">
                                        {{ $posyandu->kecamatan ?? '-' }}
                                    </h6>
                                </div>
                            </div>

                            {{-- Item: Status Data --}}
                            <div class="flex p-4 rounded-xl border border-slate-100 hover:shadow-sm transition-shadow">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-500 flex items-center justify-center">
                                        <i class="fas fa-database"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase mb-1">Status Data</p>
                                    <h6 class="font-bold text-slate-700 text-sm">Terverifikasi</h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection