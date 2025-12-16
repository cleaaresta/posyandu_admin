@extends('layouts.admin.app')

@section('title', 'Detail Jadwal')
@section('page_title', 'Detail Jadwal Posyandu')

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
            /* Agar tinggi card kiri & kanan sama */
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

        /* --- ITEM LIST DETAIL (Sama dengan halaman sebelumnya) --- */
        .info-list-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
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
        .gradient-pink {
            background: linear-gradient(135deg, #f43f5e 0%, #fb7185 100%);
        }

        .gradient-orange {
            background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%);
        }

        .gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
        }

        .gradient-slate {
            background: linear-gradient(135deg, #64748b 0%, #94a3b8 100%);
        }

        /* Typography */
        .info-content {
            flex: 1;
        }

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

        .info-desc {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            background: #f8fafc;
            padding: 12px;
            border-radius: 8px;
            border: 1px dashed #cbd5e1;
            margin-top: 4px;
        }

        /* --- STYLE POSTER COMPACT --- */
        .poster-wrapper {
            position: relative;
            width: 100%;
            max-width: 240px;
            /* Batasi lebar maksimal agar tidak raksasa */
            margin: 0 auto;
            /* Center */
            aspect-ratio: 3/4;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .poster-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .poster-wrapper:hover img {
            transform: scale(1.05);
        }

        /* Tombol Overlay di Poster */
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
        <a href="{{ route('jadwal-posyandu.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 hover:shadow-md hover:-translate-y-px active:opacity-85 transition-all">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>

        <div class="flex gap-2">
            {{-- Edit: Biru Gradient --}}
            <a href="{{ route('jadwal-posyandu.edit', $jadwal->jadwal_id) }}"
                class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>

            {{-- Hapus: Merah Gradient --}}
            <form action="{{ route('jadwal-posyandu.destroy', $jadwal->jadwal_id) }}" method="POST"
                onsubmit="return confirm('Hapus jadwal ini?');">
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

        {{-- CARD 1: POSTER KEGIATAN (Ukuran dikecilkan: w-4/12 atau w-3/12 tergantung preferensi) --}}
        <div class="w-full lg:w-4/12 px-4 mb-6">
            <div class="custom-card">
                <div class="card-header">Poster Kegiatan</div>
                <div class="card-body flex flex-col items-center justify-center">

                    {{-- Wrapper Poster (Dibatasi max-width nya di CSS) --}}
                    @if (!empty($jadwal->poster_url))
                        <div class="poster-wrapper group">
                            <img src="{{ $jadwal->poster_url }}" alt="Poster Jadwal">

                            {{-- Overlay saat hover --}}
                            <div class="poster-overlay">
                                <a href="{{ $jadwal->poster_url }}" target="_blank"
                                    class="px-4 py-2 bg-white rounded-full text-slate-800 font-bold text-xs shadow hover:bg-slate-100 transition-colors mb-2">
                                    <i class="fas fa-expand mr-1"></i> Lihat Full
                                </a>
                            </div>
                        </div>
                        <p class="text-xs text-slate-400 mt-4 text-center">
                            Klik poster untuk memperbesar
                        </p>
                    @else
                        {{-- Fallback jika tidak ada poster --}}
                        <div class="poster-wrapper bg-slate-50 flex flex-col items-center justify-center text-slate-400">
                            <i class="far fa-image text-4xl mb-2"></i>
                            <span class="text-xs font-bold">Tidak ada poster</span>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- CARD 2: DETAIL INFORMASI (Lebar sisa) --}}
        <div class="w-full lg:w-8/12 px-4 mb-6">
            <div class="custom-card">
                {{-- Judul Tema Sebagai Header Card --}}
                <div class="card-header border-l-4 border-l-blue-500">
                    {{ $jadwal->tema ?? 'Informasi Kegiatan' }}
                </div>

                <div class="card-body">

                    {{-- Item 1: Tanggal (Pink Gradient) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-pink">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Tanggal Pelaksanaan</div>
                            <div class="info-value">
                                {{ $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') : '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Item 2: Lokasi (Orange Gradient) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-orange">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Lokasi Posyandu</div>
                            <div class="info-value">
                                {{ $jadwal->posyandu->nama ?? 'Lokasi Umum' }}
                            </div>
                            <div class="text-xs text-slate-500 mt-1 font-medium">
                                {{ $jadwal->posyandu->alamat ?? '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Item 3: Deskripsi (Blue/Slate Gradient) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-slate">
                            <i class="fas fa-align-left"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Deskripsi / Keterangan</div>
                            <div class="info-desc">
                                {{ $jadwal->keterangan ?? 'Tidak ada keterangan tambahan untuk kegiatan ini.' }}
                            </div>
                        </div>
                    </div>

                    {{-- Status / Footer Kecil (Opsional) --}}
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">
                            Dibuat: {{ $jadwal->created_at ? $jadwal->created_at->diffForHumans() : '-' }}
                        </span>

                        {{-- Badge Aktif (Contoh Logic) --}}
                        @php
                            $isUpcoming = $jadwal->tanggal && \Carbon\Carbon::parse($jadwal->tanggal)->isFuture();
                        @endphp
                        @if ($isUpcoming)
                            <span
                                class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-bold border border-green-100">
                                <i class="fas fa-clock mr-1"></i> Akan Datang
                            </span>
                        @else
                            <span
                                class="px-3 py-1 bg-slate-50 text-slate-500 rounded-full text-xs font-bold border border-slate-100">
                                <i class="fas fa-check-circle mr-1"></i> Selesai
                            </span>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
