@extends('layouts.admin.app')

@section('title', 'Detail Posyandu')
@section('page_title', 'Detail Data Posyandu')

@push('styles')
    <style>
        /* --- STYLE UMUM CARD (Sama persis dengan file referensi) --- */
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
        .gradient-pink { background: linear-gradient(135deg, #f43f5e 0%, #fb7185 100%); }
        .gradient-blue { background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%); }
        .gradient-orange { background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%); }
        .gradient-purple { background: linear-gradient(135deg, #8b5cf6 0%, #c084fc 100%); }
        .gradient-green { background: linear-gradient(135deg, #10b981 0%, #34d399 100%); }

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

        /* --- GALLERY FOTO --- */
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
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
    {{-- TOOLBAR (Sama style, link disesuaikan ke Posyandu) --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <a href="{{ route('posyandu.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 hover:shadow-md hover:-translate-y-px active:opacity-85 transition-all">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>

        <div class="flex gap-2">
            {{-- Tombol Edit --}}
            <a href="{{ route('posyandu.edit', $posyandu->posyandu_id) }}"
                class="inline-flex items-center px-4 py-2 text-xs font-bold text-white uppercase transition-all bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-px active:opacity-85">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>
            
            {{-- Tombol Hapus --}}
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

    <div class="flex flex-wrap -mx-4">

        {{-- CARD 1: INFORMASI DATA (KIRI - 5/12) --}}
        <div class="w-full lg:w-5/12 px-4 mb-6">
            <div class="custom-card">
                <div class="card-header border-l-4 border-l-blue-500">
                    <i class="fas fa-hospital-alt text-blue-500"></i> Detail Informasi
                </div>

                <div class="card-body">

                    {{-- Profil Singkat --}}
                    <div class="mini-profile">
                        @if (!empty($posyandu->foto))
                            <img src="{{ $posyandu->foto_url }}" class="mini-profile-img" alt="Foto Posyandu">
                        @else
                            <div class="mini-profile-img flex items-center justify-center bg-slate-100 text-slate-400">
                                <i class="fas fa-clinic-medical text-2xl"></i>
                            </div>
                        @endif

                        <div class="mini-profile-info">
                            <h5>{{ $posyandu->nama ?? 'Nama Posyandu' }}</h5>
                            <p class="text-emerald-600 font-bold">
                                <i class="fas fa-check-circle text-xs"></i> Terverifikasi
                            </p>
                        </div>
                    </div>

                    {{-- Data List --}}
                    
                    {{-- Alamat --}}
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

                    {{-- RT / RW --}}
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

                    {{-- Kontak --}}
                    <div class="info-list-item">
                        <div class="icon-box gradient-blue">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Nomor Kontak / HP</div>
                            <div class="info-value">{{ $posyandu->kontak ?? '-' }}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- CARD 2: FOTO POSYANDU (KANAN - 7/12) --}}
        <div class="w-full lg:w-7/12 px-4 mb-6">
            <div class="custom-card">
                <div class="card-header border-l-4 border-l-orange-500">
                    <i class="fas fa-images text-orange-500"></i> Foto Posyandu
                </div>

                <div class="card-body">

                    @if (!empty($posyandu->foto))
                        {{-- Tampilan Foto Menggunakan Style Gallery --}}
                        <div class="gallery-container">
                            <div class="gallery-card group">
                                <img src="{{ $posyandu->foto_url }}" alt="Foto Posyandu">

                                {{-- Tombol Zoom Overlay --}}
                                <div class="gallery-overlay">
                                    <a href="{{ $posyandu->foto_url }}" target="_blank" class="btn-zoom">
                                        <i class="fas fa-search-plus text-blue-500"></i> Lihat Jelas
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- STATE KOSONG (JIKA TIDAK ADA FOTO) --}}
                        <div class="empty-gallery">
                            <i class="far fa-image text-5xl mb-4 text-slate-300"></i>
                            <p class="font-bold text-slate-500">Belum ada foto</p>
                            <p class="text-xs text-slate-400">Silakan edit data untuk mengupload foto</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection