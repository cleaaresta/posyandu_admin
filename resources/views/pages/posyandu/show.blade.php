@extends('layouts.admin.app')

@section('title', 'Detail Posyandu')
@section('page_title', 'Detail Data Posyandu')

@push('styles')
    <style>
        /* --- STYLE UMUM CARD --- */
        .custom-card {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid #f1f5f9;
            overflow: hidden;
            height: 100%;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 16px;
            font-weight: 700;
            color: #334155;
            background-color: #fff;
        }

        .card-body {
            padding: 24px;
        }

        /* --- ITEM LIST DETAIL --- */
        .info-list-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .info-list-item:last-child {
            margin-bottom: 0;
        }

        .icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            margin-right: 16px;
            flex-shrink: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Gradients */
        .gradient-pink { background: linear-gradient(135deg, #f43f5e 0%, #fb7185 100%); }
        .gradient-orange { background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%); }
        .gradient-blue { background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%); }

        /* Typography */
        .info-content { flex: 1; }
        .info-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }
        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
            line-height: 1.4;
        }

        /* --- STYLE FOTO COMPACT --- */
        .poster-wrapper {
            position: relative;
            width: 100%;
            max-width: 240px;
            margin: 0 auto;
            aspect-ratio: 1/1; /* Rasio Kotak */
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .poster-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
            display: block;
        }

        .poster-wrapper:hover .poster-img {
            transform: scale(1.05);
        }

        /* Placeholder */
        .poster-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background-color: #f8fafc;
            color: #94a3b8;
        }

        .poster-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .poster-wrapper:hover .poster-overlay {
            opacity: 1;
        }
    </style>
@endpush

@section('content')
    {{-- TOOLBAR ATAS --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <a href="{{ route('posyandu.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 hover:shadow-md hover:-translate-y-px active:opacity-85 transition-all">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>

        <div class="flex gap-2">
            <a href="{{ route('posyandu.edit', $posyandu->posyandu_id) }}"
                class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>

            <form action="{{ route('posyandu.destroy', $posyandu->posyandu_id) }}" method="POST"
                onsubmit="return confirm('Hapus posyandu ini?');">
                @csrf @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-red-600 to-orange-600 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                    <i class="fas fa-trash mr-2"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    {{-- LAYOUT 2 KOLOM --}}
    <div class="flex flex-wrap -mx-4">

        {{-- CARD 1: FOTO POSYANDU (KIRI) --}}
        <div class="w-full lg:w-4/12 px-4 mb-6">
            <div class="custom-card">
                <div class="card-header">Foto Posyandu</div>
                <div class="card-body flex flex-col items-center justify-center">

                    {{-- Wrapper Foto --}}
                    <div class="poster-wrapper group">
                        
                        @if (!empty($posyandu->foto))
                            
                            {{-- Tampilkan Gambar --}}
                            <img src="{{ $posyandu->foto_url }}" 
                                 alt="Foto Posyandu" 
                                 class="poster-img"
                                 onerror="this.style.display='none'; document.getElementById('fallback-icon').style.display='flex';">
                            
                            {{-- Fallback Icon (Hidden by default) --}}
                            <div id="fallback-icon" class="poster-placeholder" style="display: none;">
                                <div class="mb-3 text-slate-300">
                                    <i class="far fa-image text-5xl"></i>
                                </div>
                                <span class="text-sm font-medium text-slate-500">Tidak ada foto</span>
                            </div>

                            {{-- Overlay Zoom --}}
                            <div class="poster-overlay">
                                <a href="{{ $posyandu->foto_url }}" target="_blank"
                                    class="px-4 py-2 bg-white rounded-full text-slate-800 font-bold text-xs shadow hover:bg-slate-100 transition-colors mb-2">
                                    <i class="fas fa-expand mr-1"></i> Lihat Full
                                </a>
                            </div>

                        @else
                            {{-- Placeholder Default (Jika Database Kosong) --}}
                            <div class="poster-placeholder">
                                <div class="mb-3 text-slate-300">
                                    <i class="far fa-image text-5xl"></i>
                                </div>
                                <span class="text-sm font-medium text-slate-500">Tidak ada foto</span>
                            </div>
                        @endif
                    </div>

                    {{-- TEXT HINT (Hanya muncul jika ada foto) --}}
                    @if(!empty($posyandu->foto))
                        <p class="text-xs text-slate-400 mt-4 text-center">
                            Klik foto untuk memperbesar
                        </p>
                    @endif

                    {{-- Badge Status --}}
                    <div class="mt-4 text-center">
                        <span class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold border border-emerald-100">
                            <i class="fas fa-check-circle mr-1"></i> Terverifikasi
                        </span>
                    </div>

                </div>
            </div>
        </div>

        {{-- CARD 2: DETAIL INFORMASI (KANAN) --}}
        <div class="w-full lg:w-8/12 px-4 mb-6">
            <div class="custom-card">
                <div class="card-header border-l-4 border-l-blue-500">
                    {{ $posyandu->nama ?? 'Nama Posyandu' }}
                </div>

                <div class="card-body">
                    {{-- Item 1: Alamat --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-pink">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Alamat Lengkap</div>
                            <div class="info-value">
                                {{ $posyandu->alamat ?? 'Alamat belum diisi' }}
                            </div>
                        </div>
                    </div>

                    {{-- Item 2: RT/RW --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-orange">
                            <i class="fas fa-house-user"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Wilayah (RT / RW)</div>
                            <div class="info-value">
                                RT {{ $posyandu->rt ?? '-' }} / RW {{ $posyandu->rw ?? '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Item 3: Kontak --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-blue">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Nomor Kontak / HP</div>
                            <div class="info-value">
                                {{ $posyandu->kontak ?? '-' }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>a
    </div>
@endsection