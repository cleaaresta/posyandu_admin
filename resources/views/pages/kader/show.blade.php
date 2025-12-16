@extends('layouts.admin.app')

@section('title', 'Detail Kader')
@section('page_title', 'Detail Kader Posyandu')

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
            /* Padding header dikecilkan */
            border-bottom: 1px solid #f8fafc;
            font-size: 14px;
            font-weight: 700;
            color: #334155;
            background-color: #fff;
            letter-spacing: 0.5px;
        }

        .card-body {
            padding: 20px;
            /* Padding body dikurangi dari 24px jadi 20px agar lebih rapi */
            flex: 1;
        }

        /* --- PROFIL AREA (KIRI) --- */
        .profile-avatar-container {
            width: 120px;
            /* Sedikit diperkecil */
            height: 120px;
            margin: 0 auto 16px auto;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            font-weight: 600;
            color: #1e293b;
            background-color: #fdba74;
            /* Warna Peach/Orange */
            border: 4px solid #fff;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .profile-avatar-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
            text-align: center;
            line-height: 1.3;
        }

        .profile-nik {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 500;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        /* --- ITEM LIST DETAIL (KANAN) --- */
        .info-list-item {
            display: flex;
            align-items: flex-start;
            /* Align start agar rapi jika teks panjang */
            margin-bottom: 14px;
            /* Jarak antar item diperkecil (sebelumnya 18px) */
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
            /* JARAK ANTAR ICON & TULISAN DITAMBAH */
            flex-shrink: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-top: 2px;
            /* Penyeimbang alignment visual */
        }

        /* Gradients */
        .gradient-pink {
            background: linear-gradient(135deg, #f43f5e 0%, #fb7185 100%);
        }

        .gradient-orange {
            background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%);
        }

        .gradient-purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #c084fc 100%);
        }

        .gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
        }

        .gradient-emerald {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        }

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
    </style>
@endpush

@section('content')
    {{-- TOOLBAR ATAS --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <a href="{{ route('kader.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 hover:shadow-md hover:-translate-y-px active:opacity-85 transition-all">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>

        <div class="flex gap-2">
            {{-- Edit: Biru Gradient --}}
            <a href="{{ route('kader.edit', $kader->kader_id) }}"
                class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>

            {{-- Hapus: Merah Gradient --}}
            <form action="{{ route('kader.destroy', $kader->kader_id) }}" method="POST"
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

        {{-- KOLOM KIRI: PROFIL SIMPLE --}}
        <div class="w-full lg:w-4/12 px-4 mb-6">
            <div class="custom-card">
                {{-- Header --}}
                <div class="card-header text-center">
                    Profil Anggota Kader
                </div>

                <div class="card-body flex flex-col items-center justify-center">

                    {{-- Avatar --}}
                    @php
                        $nama = $kader->warga->nama ?? 'Tanpa Nama';
                        // Ambil inisial (Misal: Patricia Wirda -> PW)
                        $initials = collect(explode(' ', $nama))
                            ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                            ->take(2)
                            ->join('');
                    @endphp

                    <div class="profile-avatar-container">
                        @if (!empty($kader->warga->foto))
                            <img src="{{ asset('storage/' . $kader->warga->foto) }}" alt="Foto">
                        @else
                            <span>{{ $initials }}</span>
                        @endif
                    </div>

                    {{-- Nama & NIK --}}
                    <h5 class="profile-name">{{ $nama }}</h5>
                    <p class="profile-nik">
                        <i class="far fa-id-card"></i> NIK: {{ $kader->warga->no_ktp ?? '-' }}
                    </p>

                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: DETAIL INFORMASI (Lebih Rapi & Rapat) --}}
        <div class="w-full lg:w-8/12 px-4 mb-6">
            <div class="custom-card">
                <div class="card-header border-l-4 border-l-blue-500">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i> Detail Anggota Kader
                </div>

                <div class="card-body">

                    {{-- Item: Alamat (Pink) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-pink">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Alamat Lengkap</div>
                            <div class="info-value">
                                {{ $kader->posyandu->alamat ?? 'Alamat tidak tersedia' }}
                            </div>
                        </div>
                    </div>

                    {{-- Item: Posyandu (Orange) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-orange">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Posyandu</div>
                            <div class="info-value">
                                {{ $kader->posyandu->nama ?? '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Item: Jabatan (Purple) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-purple">
                            <i class="fas fa-user-tag"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Jabatan / Peran</div>
                            <div class="info-value">
                                {{ $kader->peran ?? 'Anggota Kader' }}
                            </div>
                        </div>
                    </div>

                    {{-- Item: Kontak (Blue) - Dikembalikan kesini --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-blue">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Nomor Kontak</div>
                            <div class="info-value">
                                {{ $kader->warga->telp ?? '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Item: Status (Emerald) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-emerald">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Status Keaktifan</div>
                            <div class="mt-0.5">
                                @php
                                    $is_active =
                                        empty($kader->akhir_tugas) ||
                                        \Carbon\Carbon::parse($kader->akhir_tugas)->isFuture();
                                @endphp
                                <span class="{{ $is_active ? 'text-emerald-600' : 'text-slate-500' }} font-bold text-sm">
                                    {{ $is_active ? 'Aktif & Terverifikasi' : 'Purna Tugas' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Item: Periode (Blue) --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-blue">
                            <i class="fas fa-calendar-week"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Periode Penugasan</div>
                            <div class="info-value">
                                {{ $kader->mulai_tugas ? \Carbon\Carbon::parse($kader->mulai_tugas)->format('d M Y') : '-' }}
                                <span class="text-slate-400 mx-1">s/d</span>
                                {{ $kader->akhir_tugas ? \Carbon\Carbon::parse($kader->akhir_tugas)->format('d M Y') : 'Sekarang' }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
