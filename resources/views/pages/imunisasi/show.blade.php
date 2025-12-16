@extends('layouts.admin.app')

@section('title', 'Detail Imunisasi')
@section('page_title', 'Detail Riwayat Imunisasi')

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
            display: flex;
            flex-direction: column;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 16px;
            font-weight: 700;
            color: #334155;
            background-color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-body {
            padding: 24px;
            flex: 1;
        }

        /* --- PROFIL KECIL DI CARD DATA --- */
        .mini-profile {
            display: flex;
            align-items: center;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px dashed #e2e8f0;
        }

        .mini-profile-img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #f1f5f9;
            margin-right: 16px;
        }

        .mini-profile-info h5 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .mini-profile-info p {
            font-size: 0.85rem;
            color: #64748b;
        }

        /* --- LIST DATA --- */
        .info-list-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        .info-list-item:last-child {
            margin-bottom: 0;
        }

        .icon-box {
            width: 42px;
            height: 42px;
            border-radius: 10px;
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

        .gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
        }

        .gradient-orange {
            background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%);
        }

        .gradient-purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #c084fc 100%);
        }

        .gradient-green {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        }

        .info-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #334155;
        }

        /* --- GALLERY BESAR --- */
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            /* Ukuran minimal foto besar (200px) */
            gap: 16px;
        }

        .gallery-card {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background: #fff;
            transition: transform 0.3s;
            position: relative;
            aspect-ratio: 4/3;
            /* Aspek rasio foto standar */
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .gallery-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .gallery-card:hover .gallery-overlay {
            opacity: 1;
        }

        .btn-zoom {
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 12px;
            color: #334155;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .empty-gallery {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-height: 300px;
            color: #94a3b8;
            background: #f8fafc;
            border-radius: 12px;
            border: 2px dashed #e2e8f0;
        }
    </style>
@endpush

@section('content')
    {{-- TOOLBAR --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <a href="{{ route('imunisasi.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 hover:shadow-md hover:-translate-y-px active:opacity-85 transition-all">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>

        <div class="flex gap-2">
            {{-- Edit: Biru Gradient --}}
            <a href="{{ route('imunisasi.edit', $imunisasi->imunisasi_id) }}"
                class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>
            <form action="{{ route('imunisasi.destroy', $imunisasi->imunisasi_id) }}" method="POST"
                onsubmit="return confirm('Hapus data ini?');">
                @csrf @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-red-600 to-orange-600 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                    <i class="fas fa-trash mr-2"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="flex flex-wrap -mx-4">

        {{-- CARD 1: INFORMASI DATA (KIRI - 40%) --}}
        <div class="w-full lg:w-5/12 px-4 mb-6">
            <div class="custom-card">
                <div class="card-header border-l-4 border-l-blue-500">
                    <i class="fas fa-file-medical text-blue-500"></i> Detail Imunisasi
                </div>

                <div class="card-body">

                    {{-- Profil Singkat --}}
                    <div class="mini-profile">
                        {{-- LOGIKA FOTO: Prioritas Gambar Utama -> Foto Warga -> Default --}}
                        @if (!empty($imunisasi->gambar_utama))
                            <img src="{{ $imunisasi->gambar_utama }}" class="mini-profile-img" alt="Foto Utama">
                        @elseif(!empty($imunisasi->warga->foto))
                            <img src="{{ asset('storage/' . $imunisasi->warga->foto) }}" class="mini-profile-img"
                                alt="Foto Warga">
                        @else
                            <div class="mini-profile-img flex items-center justify-center bg-slate-100 text-slate-400">
                                <i class="fas fa-child text-2xl"></i>
                            </div>
                        @endif

                        <div class="mini-profile-info">
                            <h5>{{ $imunisasi->warga->nama ?? 'Nama Tidak Tersedia' }}</h5>
                            <p>NIK: {{ $imunisasi->warga->no_ktp ?? '-' }}</p>


                        </div>
                    </div>

                    {{-- Data List --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-pink">
                            <i class="far fa-calendar-check"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Tanggal Pelaksanaan</div>
                            <div class="info-value">
                                {{ $imunisasi->tanggal ? \Carbon\Carbon::parse($imunisasi->tanggal)->translatedFormat('d F Y') : '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="info-list-item">
                        <div class="icon-box gradient-blue">
                            <i class="fas fa-syringe"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Jenis Vaksin</div>
                            <div class="info-value">{{ $imunisasi->jenis_vaksin ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="info-list-item">
                        <div class="icon-box gradient-orange">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Lokasi</div>
                            <div class="info-value">{{ $imunisasi->lokasi ?? 'Posyandu Umum' }}</div>
                        </div>
                    </div>

                    <div class="info-list-item">
                        <div class="icon-box gradient-purple">
                            <i class="fas fa-user-nurse"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Tenaga Kesehatan</div>
                            <div class="info-value">{{ $imunisasi->nakes ?? '-' }}</div>
                        </div>
                    </div>

                    @if (!empty($imunisasi->keterangan))
                        <div class="info-list-item">
                            <div class="icon-box gradient-green">
                                <i class="fas fa-sticky-note"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Catatan</div>
                                <div class="info-value font-normal text-sm text-slate-600">
                                    {{ $imunisasi->keterangan }}
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- CARD 2: DOKUMENTASI (KANAN - 60% & FULL CARD) --}}
        <div class="w-full lg:w-7/12 px-4 mb-6">
            <div class="custom-card">
                <div class="card-header border-l-4 border-l-orange-500">
                    <i class="fas fa-images text-orange-500"></i> Dokumentasi Kegiatan
                </div>

                <div class="card-body">

                    @if ($imunisasi->dokumentasi && $imunisasi->dokumentasi->count() > 0)
                        {{-- GRID FOTO BESAR --}}
                        <div class="gallery-container">
                            @foreach ($imunisasi->dokumentasi as $foto)
                                <div class="gallery-card group">
                                    <img src="{{ asset('storage/' . $foto->file_url) }}" alt="Dokumentasi">

                                    {{-- Tombol Zoom Overlay --}}
                                    <div class="gallery-overlay">
                                        <a href="{{ asset('storage/' . $foto->file_url) }}" target="_blank"
                                            class="btn-zoom">
                                            <i class="fas fa-search-plus text-blue-500"></i> Lihat Jelas
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{-- STATE KOSONG (JIKA TIDAK ADA FOTO) --}}
                        <div class="empty-gallery">
                            <i class="far fa-image text-5xl mb-4 text-slate-300"></i>
                            <p class="font-bold text-slate-500">Belum ada dokumentasi</p>
                            <p class="text-xs text-slate-400">Silakan edit data untuk mengupload foto</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection
