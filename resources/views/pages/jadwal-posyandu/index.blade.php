@extends('layouts.admin.app')

{{-- Judul Halaman (tampil di tab browser) --}}
@section('title', 'Data Jadwal Posyandu')

{{-- Judul Halaman (tampil di atas konten) --}}
@section('page_title', 'Data Jadwal Posyandu')

{{-- Konten Utama --}}
@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="p-6">
                    <a href="{{ route('jadwal-posyandu.create') }}"
                        class="inline-block px-6 py-3 mb-4 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                        <i class="fas fa-plus mr-1"></i> Tambah Data Jadwal
                    </a>

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
                                        Poster</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Tema Kegiatan</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Nama Posyandu</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Tanggal</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jadwals as $jadwal)
                                    <tr>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            @if ($jadwal->poster)
                                                <img src="{{ asset('storage/jadwal_posters/' . $jadwal->poster) }}"
                                                    class="w-16 h-16 object-cover rounded" alt="Poster Kegiatan">
                                            @else
                                                <span class="text-xs px-3">Tidak ada</span>
                                            @endif
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $jadwal->tema }}
                                            </h6>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            {{-- Menampilkan nama posyandu dari relasi --}}
                                            <p
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                {{ $jadwal->posyandu->nama ?? 'N/A' }}</p>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            {{-- Format tanggal agar mudah dibaca --}}
                                            <p
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                {{ $jadwal->tanggal->format('d F Y') }}</p>
                                        </td>

                                        <td
                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">

                                            <form action="{{ route('jadwal-posyandu.destroy', $jadwal->jadwal_id) }}"
                                                method="POST" class="inline-block">

                                                <a href="{{ route('jadwal-posyandu.edit', $jadwal->jadwal_id) }}"
                                                    class="inline-block px-3 py-1.5 mr-1 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-emerald-500 to-teal-400 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-block px-3 py-1.5 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-orange-600 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 font-semibold leading-tight dark:text-white dark:opacity-60">
                                                Tidak ada data jadwal.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $jadwals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Script untuk auto-hide alert --}}
    <script>
        window.setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = 'opacity 500ms ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>
@endpush