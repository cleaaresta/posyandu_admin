@extends('layouts.admin.app')

@section('title', 'Data Warga')
@section('page_title', 'Data Warga')

@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">

                {{-- HEADER: TOOLBAR (TOMBOL TAMBAH & FILTER PENCARIAN) --}}
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    
                    {{-- Container Utama: Flexbox --}}
                    <div class="flex flex-col lg:flex-row justify-between items-center gap-4">

                        {{-- 1. BAGIAN KIRI: TOMBOL TAMBAH --}}
                        <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none mb-4 md:mb-0">
                            <a href="{{ route('warga.create') }}"
                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                <i class="fas fa-plus mr-1"></i> Tambah Warga
                            </a>
                        </div>

                        {{-- 2. BAGIAN KANAN: FORM SEARCH & FILTER --}}
                        <div class="w-full lg:w-auto">
                            {{-- Form Container: Gunakan items-center agar tinggi elemen seragam --}}
                            <form action="{{ route('warga.index') }}" method="GET" 
                                  class="flex flex-col lg:flex-row items-center gap-2 w-full">
                                
                                {{-- A. Filter Gender --}}
                                <select name="jenis_kelamin" onchange="this.form.submit()"
                                    class="w-full lg:w-32 px-3 py-2 text-sm rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white focus:shadow-primary-outline focus:border-blue-500 focus:outline-none transition-all cursor-pointer h-10">
                                    <option value="">Semua Gender</option>
                                    <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>

                                {{-- B. Filter Agama --}}
                                <select name="agama" onchange="this.form.submit()"
                                    class="w-full lg:w-32 px-3 py-2 text-sm rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white focus:shadow-primary-outline focus:border-blue-500 focus:outline-none transition-all cursor-pointer h-10">
                                    <option value="">Semua Agama</option>
                                    @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'] as $agama)
                                        <option value="{{ $agama }}" {{ request('agama') == $agama ? 'selected' : '' }}>
                                            {{ $agama }}
                                        </option>
                                    @endforeach
                                </select>

                                {{-- C. Search Group --}}
                                <div class="flex w-full lg:w-64 items-center">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="pl-4 pr-3 py-2 text-sm w-full rounded-l-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white focus:shadow-primary-outline focus:border-blue-500 focus:outline-none transition-all placeholder:text-gray-500 h-10"
                                        placeholder="Cari Nama/NIK..." />
                                    
                                    <button type="submit"
                                        class="inline-block px-4 py-2 font-bold text-center text-white uppercase align-middle transition-all rounded-r-lg cursor-pointer bg-gradient-to-tl from-slate-600 to-slate-300 leading-normal text-xs ease-in tracking-tight-rem shadow-xs hover:-translate-y-px active:opacity-85 border border-transparent h-10 flex items-center justify-center">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>

                                {{-- D. Tombol Reset --}}
                                @if (request('search') || request('jenis_kelamin') || request('agama'))
                                    <a href="{{ route('warga.index') }}"
                                        class="inline-block w-full lg:w-auto px-4 py-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-orange-600 leading-normal text-xs ease-in tracking-tight-rem shadow-xs hover:-translate-y-px active:opacity-85 flex items-center justify-center h-10"
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
                        <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No. KTP</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">J. Kelamin</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Telepon</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($warga as $index => $w)
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60 px-4">{{ $index + $warga->firstItem() }}</p>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60 px-2">{{ $w->no_ktp }}</p>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white px-2">{{ $w->nama }}</h6>
                                            <p class="mb-0 text-xs leading-tight text-slate-400 dark:text-white dark:opacity-60 px-2">{{ $w->email }}</p>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60 px-2">{{ $w->jenis_kelamin }}</p>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60 px-2">{{ $w->telp }}</p>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <form action="{{ route('warga.destroy', $w->warga_id) }}" method="POST" class="inline-block">
                                                <a href="{{ route('warga.edit', $w->warga_id) }}" class="inline-block px-3 py-1.5 mr-1 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-emerald-500 to-teal-400 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                                @csrf @method('DELETE')
                                                <button type="submit" class="inline-block px-3 py-1.5 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-orange-600 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-4 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex flex-col items-center justify-center">
                                                <span class="text-slate-400 mb-2"><i class="fas fa-user-slash fa-3x"></i></span>
                                                <p class="mb-0 font-semibold leading-tight dark:text-white dark:opacity-60">Tidak ada data Warga ditemukan.</p>
                                                @if (request('search') || request('jenis_kelamin') || request('agama'))
                                                    <p class="text-xs text-slate-400 mt-1">Coba reset filter atau cari kata kunci lain.</p>
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
                            Showing <span class="font-bold">{{ $warga->firstItem() ?? 0 }}</span> to <span class="font-bold">{{ $warga->lastItem() ?? 0 }}</span> of <span class="font-bold">{{ $warga->total() }}</span> results
                        </div>
                        <div>
                            {{ $warga->links() }}
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