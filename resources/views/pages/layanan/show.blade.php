@extends('layouts.admin.app')

@section('title', 'Detail Pemeriksaan')
@section('page_title', 'Detail Pemeriksaan & Layanan')

@push('styles')
    <style>
        /* --- STYLE CARD UMUM --- */
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
            padding: 16px 20px;
            /* Padding lebih kecil agar compact */
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            font-weight: 700;
            color: #334155;
            background-color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.5px;
        }

        .card-body {
            padding: 20px;
            /* Padding body dikurangi */
            flex: 1;
        }

        /* --- PROFIL AREA (KIRI) --- */
        .profile-img-container {
            width: 120px;
            /* Ukuran fix 120px (lebih kecil dari sebelumnya) */
            height: 120px;
            margin: 0 auto 16px auto;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #fff;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            background-color: #f1f5f9;
        }

        .profile-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .profile-img-container:hover img {
            transform: scale(1.05);
        }

        .profile-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
            text-align: center;
            line-height: 1.3;
        }

        .profile-meta {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 500;
            text-align: center;
        }

        /* --- ITEM LIST DETAIL (KANAN) --- */
        .info-list-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 14px;
            /* Jarak antar item diperkecil */
            padding-bottom: 14px;
            border-bottom: 1px dashed #f1f5f9;
        }

        .info-list-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .icon-box {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            margin-right: 20px;
            /* Jarak Icon ke Teks ditambah */
            flex-shrink: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-top: 2px;
        }

        /* Gradients */
        .gradient-pink {
            background: linear-gradient(135deg, #f43f5e 0%, #fb7185 100%);
        }

        .gradient-cyan {
            background: linear-gradient(135deg, #06b6d4 0%, #22d3ee 100%);
        }

        .gradient-emerald {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        }

        .gradient-orange {
            background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%);
        }

        .gradient-purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #c084fc 100%);
        }

        .gradient-slate {
            background: linear-gradient(135deg, #64748b 0%, #94a3b8 100%);
        }

        .gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
        }

        /* Typography */
        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 2px;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            line-height: 1.4;
        }

        .info-unit {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
            margin-left: 2px;
        }

        .notes-box {
            background-color: #f1f5f9;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            color: #475569;
            margin-top: 4px;
            border-left: 3px solid #cbd5e1;
        }
    </style>
@endpush

@section('content')
    {{-- TOOLBAR ATAS --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <a href="{{ route('layanan.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 hover:shadow-md hover:-translate-y-px active:opacity-85 transition-all">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>

        <div class="flex gap-2">
            {{-- Edit: Biru Gradient --}}
            <a href="{{ route('layanan.edit', $layanan->layanan_id) }}"
                class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>

            {{-- Hapus: Merah Gradient --}}
            <form action="{{ route('layanan.destroy', $layanan->layanan_id) }}" method="POST"
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

        {{-- KOLOM KIRI: PROFIL WARGA --}}
        <div class="w-full lg:w-4/12 px-4 mb-6">
            <div class="custom-card text-center">
                <div class="card-header justify-center bg-slate-50">
                    Profil Peserta
                </div>
                <div class="card-body flex flex-col items-center justify-center">

                    {{-- Foto Profil --}}
                    <div class="profile-img-container">
                        <img src="{{ $layanan->warga->foto_url ?? asset('assets/img/default-user.png') }}" alt="Foto">
                    </div>

                    {{-- Nama & NIK --}}
                    <h5 class="profile-name">{{ $layanan->warga->nama ?? 'Tanpa Nama' }}</h5>
                    <p class="profile-meta">
                        <i class="fas fa-id-card mr-1"></i> NIK: {{ $layanan->warga->no_ktp ?? '-' }}
                    </p>

                    {{-- Kotak Kontak dihapus, dipindah ke kanan --}}

                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: HASIL PEMERIKSAAN --}}
        <div class="w-full lg:w-8/12 px-4 mb-6">
            <div class="custom-card">
                <div class="card-header border-l-4 border-l-blue-500">
                    <i class="fas fa-notes-medical text-blue-500"></i>
                    Hasil Pemeriksaan
                </div>

                <div class="card-body">

                    {{-- Item: Tanggal (Pink) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-pink">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Tanggal Pemeriksaan</span>
                            <div class="info-value">
                                {{ $layanan->jadwal && $layanan->jadwal->tanggal ? \Carbon\Carbon::parse($layanan->jadwal->tanggal)->translatedFormat('l, d F Y') : '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Item: Kontak Warga (Dipindah kesini - Blue) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-blue">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Nomor Kontak</span>
                            <div class="info-value">
                                {{ $layanan->warga->telp ?? '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Item: Berat Badan (Cyan) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-cyan">
                            <i class="fas fa-weight"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Berat Badan</span>
                            <div class="info-value">
                                {{ $layanan->berat }} <span class="info-unit">kg</span>
                            </div>
                        </div>
                    </div>

                    {{-- Item: Tinggi Badan (Emerald) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-emerald">
                            <i class="fas fa-ruler-vertical"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Tinggi Badan</span>
                            <div class="info-value">
                                {{ $layanan->tinggi }} <span class="info-unit">cm</span>
                            </div>
                        </div>
                    </div>

                    {{-- Item: Vitamin/Obat (Orange) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-orange">
                            <i class="fas fa-pills"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Vitamin / Obat</span>
                            <div class="info-value">
                                {{ $layanan->vitamin ?? '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Item: Konseling (Purple) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-purple">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Konseling / Keluhan</span>
                            <div class="info-value">
                                {{ $layanan->konseling ?? '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Item: Catatan Tambahan (Slate - Jika ada) --}}
                    <div class="info-list-item border-0">
                        <div class="icon-box gradient-slate items-start pt-3 h-auto min-h-[42px]">
                            <i class="fas fa-sticky-note"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Catatan Tambahan</span>
                            <div class="notes-box">
                                {{ $layanan->catatan ?? 'Tidak ada catatan khusus.' }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
