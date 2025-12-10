@extends('layouts.admin.app')

@section('title', 'Data Posyandu')
@section('page_title', 'Data Posyandu')

@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            {{-- CARD UTAMA: bg-white memastikan background putih solid --}}
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">

                {{-- HEADER: TOOLBAR (TOMBOL TAMBAH & PENCARIAN) --}}
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">

                    {{-- Container Utama: Flexbox --}}
                    <div class="flex flex-col lg:flex-row justify-between items-center gap-4">

                        {{-- 1. BAGIAN KIRI: TOMBOL TAMBAH --}}
                        <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none mb-4 md:mb-0">
                            <a href="{{ route('posyandu.create') }}"
                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                <i class="fas fa-plus mr-1"></i> Tambah Posyandu
                            </a>
                        </div>

                        {{-- 2. BAGIAN KANAN: FORM SEARCH --}}
                        <div class="w-full lg:w-auto">
                            <form action="{{ route('posyandu.index') }}" method="GET"
                                class="flex flex-col lg:flex-row items-center gap-2 w-full">

                                {{-- A. Search Input (bg-white agar tidak transparan) --}}
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="w-full lg:w-64 px-4 py-2 text-sm rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white focus:shadow-primary-outline focus:border-blue-500 focus:outline-none transition-all placeholder:text-gray-500 h-10 mb-2 lg:mb-0"
                                    placeholder="Cari Nama Posyandu..." />

                                {{-- B. Search Button --}}
                                <button type="submit"
                                    class="inline-block px-4 py-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-slate-600 to-slate-300 leading-normal text-xs ease-in tracking-tight-rem shadow-xs hover:-translate-y-px active:opacity-85 border border-transparent h-10 flex items-center justify-center mb-2 lg:mb-0">
                                    <i class="fas fa-search"></i>
                                </button>

                                {{-- C. Tombol Reset --}}
                                @if (request('search'))
                                    <a href="{{ route('posyandu.index') }}"
                                        class="inline-block px-4 py-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-orange-600 leading-normal text-xs ease-in tracking-tight-rem shadow-xs hover:-translate-y-px active:opacity-85 flex items-center justify-center h-10"
                                        title="Reset Filter">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                {{-- KONTEN TABEL --}}
                <div class="p-6">
                    {{-- Alert Success --}}
                    @if (session('success'))
                        <div id="success-alert" class="relative w-full p-4 pr-12 mb-4 text-white rounded-lg"
                            style="background-color: #2dce89;" role="alert">
                            <span class="font-semibold">Sukses!</span> {{ session('success') }}
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                                onclick="document.getElementById('success-alert').style.display='none'">
                                <span class="text-2xl" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table
                            class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        No</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Nama Posyandu</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Alamat</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Kontak</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posyandus as $index => $item)
                                    <tr>
                                        {{-- Kolom No --}}
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60 px-4">
                                                {{ $index + $posyandus->firstItem() }}
                                            </p>
                                        </td>

                                        {{-- Kolom Nama & Foto (foto/inisial fallback) --}}
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">

                                            <div class="flex px-2 py-1">
                                                <div>
                                                    @php
                                                        // 1. Tentukan path gambar placeholder lokal (Pastikan file ini ada di folder public)
                                                        // Contoh lokasi: public/assets/img/default-placeholder.jpg
                                                        $defaultImage = asset( 'assets-admin/img/team/posyandu1.png',);

                                                        // 2. Cek apakah data memiliki foto
                                                        $hasFoto = !empty($item->foto);

                                                        // 3. Tentukan Avatar: Jika ada foto pakai foto_url, jika tidak pakai defaultImage
                                                        $avatar = $hasFoto ? $item->foto_url : $defaultImage;
                                                    @endphp

                                                    <img src="{{ $avatar }}"
                                                        class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-in-out text-sm h-9 w-9 rounded-lg object-cover border border-slate-100"
                                                        alt="{{ $item->nama }}" loading="lazy" /> {{-- loading="lazy" membantu performa muat gambar --}}
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm leading-normal dark:text-white">
                                                        {{ $item->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Kolom Alamat --}}
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60 px-2">
                                                {{ Str::limit($item->alamat, 30) }}
                                            </p>
                                            <p
                                                class="mb-0 text-xs leading-tight text-slate-400 dark:text-white dark:opacity-60 px-2">
                                                RT {{ $item->rt }} / RW {{ $item->rw }}
                                            </p>
                                        </td>

                                        {{-- Kolom Kontak --}}
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60 px-2">
                                                {{ $item->kontak ?? '-' }}
                                            </p>
                                        </td>

                                        {{-- Kolom Aksi --}}
                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            {{-- Form Wrapper untuk Tombol Sejajar --}}
                                            <form action="{{ route('posyandu.destroy', $item->posyandu_id) }}"
                                                method="POST" class="inline-block">

                                                {{-- Tombol DETAIL (SHOW) - Biru --}}
                                                <a href="{{ route('posyandu.show', $item->posyandu_id) }}"
                                                    class="inline-block px-3 py-1.5 mr-1 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                                    <i class="fas fa-eye mr-1"></i> Detail
                                                </a>

                                                {{-- Tombol EDIT - Hijau/Teal --}}
                                                <a href="{{ route('posyandu.edit', $item->posyandu_id) }}"
                                                    class="inline-block px-3 py-1.5 mr-1 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-emerald-500 to-teal-400 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>

                                                {{-- Tombol HAPUS - Merah --}}

                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="inline-block px-3 py-1.5 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-orange-600 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data Posyandu ini?')">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="p-4 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex flex-col items-center justify-center">
                                                <span class="text-slate-400 mb-2"><i
                                                        class="fas fa-hospital-alt fa-3x"></i></span>
                                                <p class="mb-0 font-semibold leading-tight dark:text-white dark:opacity-60">
                                                    Tidak ada data Posyandu ditemukan.</p>
                                                @if (request('search'))
                                                    <p class="text-xs text-slate-400 mt-1">Coba reset pencarian.</p>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    <div class="flex flex-wrap justify-between items-center mt-4">
                        <div class="text-sm text-slate-500 mb-2 md:mb-0">
                            Showing <span class="font-bold">{{ $posyandus->firstItem() ?? 0 }}</span> to <span
                                class="font-bold">{{ $posyandus->lastItem() ?? 0 }}</span> of <span
                                class="font-bold">{{ $posyandus->total() }}</span> results
                        </div>
                        <div>
                            {{ $posyandus->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Script untuk menghilangkan alert secara otomatis
        window.setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = 'opacity 500ms ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.style.display = 'none', 500);
            }
        }, 5000);
    </script>
@endpush
