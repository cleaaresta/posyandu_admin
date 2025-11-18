@extends('layouts.admin.app')

@section('title', 'Data Jadwal Posyandu')
@section('page_title', 'Data Jadwal Posyandu')

@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                
                {{-- HEADER: TOMBOL TAMBAH (Kiri) & SEARCH (Kanan) --}}
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="flex flex-wrap justify-between items-center">
                        
                        {{-- 1. Tombol Tambah --}}
                        <div class="mb-2 md:mb-0">
                            <a href="{{ route('jadwal-posyandu.create') }}"
                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                <i class="fas fa-plus mr-1"></i> Tambah Jadwal
                            </a>
                        </div>

                        {{-- 2. Form Search (Kanan) --}}
                        <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none">
                            <form action="{{ route('jadwal-posyandu.index') }}" method="GET"
                                class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                                <div class="flex w-full">
                                    {{-- Input Field --}}
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="pl-4 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
                                        placeholder="Cari nama, alamat, kontak..." />

                                    {{-- Tombol Search (Kaca Pembesar) --}}
                                    <button type="submit"
                                        class="inline-block px-4 py-2 ml-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-slate-600 to-slate-300 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                        <i class="fas fa-search"></i>
                                    </button>

                                {{-- Tombol Reset (Merah - Muncul jika ada search) --}}
                                @if(request('search'))
                                    <a href="{{ route('jadwal-posyandu.index') }}"
                                            class="inline-block px-4 py-2 ml-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-orange-600 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85"
                                            title="Reset Pencarian">
                                            <i class="fas fa-times"></i>
                                        </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

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

                    {{-- Tabel Data --}}
                    <div class="overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b text-xxs text-slate-400 opacity-70">Poster</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b text-xxs text-slate-400 opacity-70">Nama Posyandu</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b text-xxs text-slate-400 opacity-70">Tanggal</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b text-xxs text-slate-400 opacity-70">Tema</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b text-xxs text-slate-400 opacity-70">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jadwals as $jadwal)
                                    <tr>
                                        <td class="p-2 align-middle border-b dark:border-white/40">
                                            @if ($jadwal->poster)
                                                <img src="{{ asset('storage/jadwal_posters/' . $jadwal->poster) }}" class="w-16 h-16 object-cover rounded" alt="Poster">
                                            @else
                                                <span class="text-xs px-3">Tidak ada poster</span>
                                            @endif
                                        </td>
                                        <td class="p-2 align-middle border-b dark:border-white/40">
                                            <h6 class="mb-0 text-sm dark:text-white">{{ $jadwal->posyandu->nama ?? 'Posyandu dihapus' }}</h6>
                                        </td>
                                        <td class="p-2 align-middle border-b dark:border-white/40">
                                            <p class="text-xs font-semibold mb-0 dark:text-white opacity-80">{{ $jadwal->tanggal->format('d M Y') }}</p>
                                        </td>
                                        <td class="p-2 align-middle border-b dark:border-white/40">
                                            <p class="text-xs font-semibold mb-0 dark:text-white opacity-80">{{ Str::limit($jadwal->tema, 40) }}</p>
                                        </td>
                                        <td class="p-2 text-center align-middle border-b dark:border-white/40">
                                            <form action="{{ route('jadwal-posyandu.destroy', $jadwal->jadwal_id) }}" method="POST" class="inline-block">
                                                <a href="{{ route('jadwal-posyandu.edit', $jadwal->jadwal_id) }}" class="inline-block px-3 py-1.5 mr-1 font-bold text-center text-white uppercase align-middle transition-all rounded-lg bg-gradient-to-tl from-emerald-500 to-teal-400 text-xs ease-in shadow-xs hover:-translate-y-px">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                                @csrf @method('DELETE')
                                                <button type="submit" class="inline-block px-3 py-1.5 font-bold text-center text-white uppercase align-middle transition-all rounded-lg bg-gradient-to-tl from-red-600 to-orange-600 text-xs ease-in shadow-xs hover:-translate-y-px" onclick="return confirm('Hapus jadwal ini?')">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-4 text-center border-b dark:border-white/40">
                                            <p class="text-slate-500 dark:text-white">Tidak ada data jadwal ditemukan.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- FOOTER: PAGINATION INFO & LINKS --}}
                    <div class="flex flex-wrap justify-between items-center mt-4 border-t pt-4">
                        {{-- Text Info --}}
                        <div class="text-sm text-slate-500 dark:text-white mb-2 md:mb-0">
                            Showing 
                            <span class="font-bold text-slate-700 dark:text-white">{{ $jadwals->firstItem() ?? 0 }}</span> 
                            to 
                            <span class="font-bold text-slate-700 dark:text-white">{{ $jadwals->lastItem() ?? 0 }}</span> 
                            of 
                            <span class="font-bold text-slate-700 dark:text-white">{{ $jadwals->total() }}</span> 
                            results
                        </div>

                        {{-- Links --}}
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
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>
@endpush