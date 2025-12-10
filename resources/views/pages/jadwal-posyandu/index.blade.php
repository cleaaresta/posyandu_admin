@extends('layouts.admin.app')

{{-- Judul Halaman --}}
@section('title', 'Jadwal Posyandu')
@section('page_title', 'Data Jadwal Posyandu')

@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            {{-- CARD UTAMA --}}
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">

                {{-- HEADER: TOOLBAR (Tambah & Pencarian) --}}
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="flex flex-col lg:flex-row justify-between items-center gap-4">

                        {{-- 1. Tombol Tambah --}}
                        <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none mb-4 md:mb-0">
                            <a href="{{ route('jadwal-posyandu.create') }}"
                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                <i class="fas fa-plus mr-1"></i> Buat Jadwal
                            </a>
                        </div>

                        {{-- 2. Form Pencarian --}}
                        <div class="w-full lg:w-auto">
                            <form action="{{ route('jadwal-posyandu.index') }}" method="GET"
                                class="flex flex-col lg:flex-row items-center gap-2 w-full">

                                {{-- Input Search --}}
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="w-full lg:w-64 px-4 py-2 text-sm rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white focus:shadow-primary-outline focus:border-blue-500 focus:outline-none transition-all placeholder:text-gray-500 h-10 mb-2 lg:mb-0"
                                    placeholder="Cari Tema / Posyandu..." />

                                {{-- Tombol Cari --}}
                                <button type="submit"
                                    class="inline-block px-4 py-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-slate-600 to-slate-300 leading-normal text-xs ease-in tracking-tight-rem shadow-xs hover:-translate-y-px active:opacity-85 border border-transparent h-10 flex items-center justify-center mb-2 lg:mb-0">
                                    <i class="fas fa-search"></i>
                                </button>

                                {{-- Tombol Reset --}}
                                @if (request('search'))
                                    <a href="{{ route('jadwal-posyandu.index') }}"
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
                                        Kegiatan & Tema</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Posyandu</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Waktu Pelaksanaan</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwals as $item)
                                    <tr>

                                        {{-- Kolom Nomor Urut --}}
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60 px-4">
                                                {{ $loop->index + $jadwals->firstItem() }}
                                            </p>
                                        </td>
{{-- Poster & Tema --}}
<td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
    <div class="flex px-2 py-1">
        <div>
            {{-- Cukup panggil accessor poster_url, logika default sudah diatur di Model --}}
            <img src="{{ $item->poster_url }}"
                class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-in-out text-sm h-9 w-9 rounded-lg object-cover border border-slate-200"
                alt="Poster {{ $item->tema }}" 
                loading="lazy" />
        </div>
        <div class="flex flex-col justify-center">
            <h6 class="mb-0 text-sm leading-normal dark:text-white">
                {{ Str::limit($item->tema, 40) }}
            </h6>
            <p class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">
                Topik Kesehatan
            </p>
        </div>
    </div>
</td>

                                        {{-- Kolom Posyandu --}}
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            {{-- LOGIKA: Null check pada relasi --}}
                                            <p
                                                class="mb-0 text-xs font-bold leading-tight dark:text-white dark:opacity-80">
                                                {{ $item->posyandu->nama ?? 'Umum' }}
                                            </p>
                                        </td>

                                        {{-- Kolom Tanggal --}}
                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span
                                                class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                {{ $item->tanggal ? $item->tanggal->translatedFormat('d F Y') : '-' }}
                                            </span>
                                        </td>

                                        {{-- Kolom Aksi --}}
                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            {{-- Form Wrapper untuk Tombol Hapus --}}
                                            <form action="{{ route('jadwal-posyandu.destroy', $item->jadwal_id) }}"
                                                method="POST" class="inline-block">

                                                {{-- Tombol DETAIL (SHOW) --}}
                                                <a href="{{ route('jadwal-posyandu.show', $item->jadwal_id) }}"
                                                    class="inline-block px-3 py-1.5 mr-1 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                                    <i class="fas fa-eye mr-1"></i> Detail
                                                </a>
                                                {{-- Tombol EDIT --}}
                                                <a href="{{ route('jadwal-posyandu.edit', $item->jadwal_id) }}"
                                                    class="inline-block px-3 py-1.5 mr-1 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-emerald-500 to-teal-400 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>

                                                {{-- Tombol HAPUS --}}
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="inline-block px-3 py-1.5 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-orange-600 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data Jadwal Posyandu ini?')">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- Tampilkan jika data kosong --}}
                                    <tr>
                                        <td colspan="5"
                                            class="p-4 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex flex-col items-center justify-center">
                                                <span class="text-slate-400 mb-2"><i
                                                        class="far fa-calendar-times fa-3x"></i></span>
                                                <p class="mb-0 font-semibold leading-tight dark:text-white dark:opacity-60">
                                                    Belum ada jadwal kegiatan ditemukan.</p>
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
                            Showing <span class="font-bold">{{ $jadwals->firstItem() ?? 0 }}</span> to <span
                                class="font-bold">{{ $jadwals->lastItem() ?? 0 }}</span> of <span
                                class="font-bold">{{ $jadwals->total() }}</span> results
                        </div>
                        <div>
                            {{ $jadwals->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
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