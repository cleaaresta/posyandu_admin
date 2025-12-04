@extends('layouts.admin.app')

@section('title', 'Tambah Data Imunisasi')
@section('page_title', 'Tambah Data Imunisasi')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <h5 class="mb-0 dark:text-white">Input Catatan Imunisasi</h5>
            </div>
            <div class="flex-auto p-6">
                
                <form action="{{ route('imunisasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Pilih Warga (FK) --}}
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Nama Warga</label>
                        <select name="warga_id" required class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2">
                            <option value="">-- Pilih Warga --</option>
                            @foreach($wargas as $warga)
                                <option value="{{ $warga->warga_id }}" {{ old('warga_id') == $warga->warga_id ? 'selected' : '' }}>
                                    {{ $warga->nama }} - {{ $warga->no_ktp ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                        @error('warga_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Jenis Vaksin --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Jenis Vaksin</label>
                        <input type="text" name="jenis_vaksin" value="{{ old('jenis_vaksin') }}" placeholder="Contoh: Polio, Campak, COVID-19" required class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2" />
                        @error('jenis_vaksin') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex gap-4 mb-4">
                        <div class="w-1/2">
                            <label class="text-xs font-bold text-slate-700 dark:text-white/80">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2" />
                            @error('tanggal') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="w-1/2">
                            <label class="text-xs font-bold text-slate-700 dark:text-white/80">Tenaga Kesehatan</label>
                            <input type="text" name="nakes" value="{{ old('nakes') }}" placeholder="Nama Bidan/Dokter" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2" />
                            @error('nakes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Lokasi / Tempat</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Posyandu Mawar, Puskesmas" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2" />
                        @error('lokasi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Dokumentasi (media) --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Dokumentasi / Bukti (Opsional)</label>
                        <input type="file" name="dokumentasi[]" multiple class="block w-full text-sm text-slate-500" />
                        <small class="text-slate-400">Bisa upload banyak foto (scan kartu imunisasi, bukti, dll).</small>
                        @error('dokumentasi.*') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                    </div>

                    <div class="text-right mt-6">
                        <a href="{{ route('imunisasi.index') }}" class="inline-flex items-center px-6 py-3 mr-2 font-bold bg-gray-200 rounded-lg text-slate-700 text-xs">
                            <i class="fas fa-ban mr-2"></i> Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 font-bold text-white rounded-lg bg-gradient-to-tl from-blue-500 to-violet-500 text-xs">
                            <i class="fas fa-save mr-2"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection