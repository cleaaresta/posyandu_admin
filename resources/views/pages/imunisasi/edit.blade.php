@extends('layouts.admin.app')

@section('title', 'Edit Data Imunisasi')
@section('page_title', 'Edit Data Imunisasi')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <h5 class="mb-0 dark:text-white">Edit Catatan Imunisasi</h5>
            </div>
            <div class="flex-auto p-6">
                
                <form action="{{ route('imunisasi.update', $imunisasi->imunisasi_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    {{-- Pilih Warga (FK) --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Nama Warga</label>
                        <select name="warga_id" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2">
                            @foreach($wargas as $warga)
                                <option value="{{ $warga->warga_id }}" {{ (old('warga_id', $imunisasi->warga_id) == $warga->warga_id) ? 'selected' : '' }}>
                                    {{ $warga->nama }} - {{ $warga->no_ktp ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                        @error('warga_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Jenis Vaksin --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Jenis Vaksin</label>
                        <input type="text" name="jenis_vaksin" value="{{ old('jenis_vaksin', $imunisasi->jenis_vaksin) }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2" />
                        @error('jenis_vaksin') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex gap-4 mb-4">
                        <div class="w-1/2">
                            <label class="text-xs font-bold text-slate-700 dark:text-white/80">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', $imunisasi->tanggal ? $imunisasi->tanggal->format('Y-m-d') : '') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2" />
                            @error('tanggal') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="w-1/2">
                            <label class="text-xs font-bold text-slate-700 dark:text-white/80">Tenaga Kesehatan</label>
                            <input type="text" name="nakes" value="{{ old('nakes', $imunisasi->nakes) }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2" />
                            @error('nakes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $imunisasi->lokasi) }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2" />
                        @error('lokasi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Dokumentasi sekarang --}}
                    <div class="mb-6">
                        <label class="text-xs font-bold text-slate-700 mb-2 block">Dokumentasi Saat Ini</label>
                        
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($imunisasi->dokumentasi as $media)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $media->file_url) }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200 shadow-sm">
                                    
                                    {{-- Hapus Media (pastikan route ada) --}}
                                    <a href="{{ route('media.delete.imunisasi', $media->media_id) }}" 
                                       onclick="return confirm('Hapus foto ini?')"
                                       class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                       <i class="fas fa-times"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <input type="file" name="dokumentasi[]" multiple class="block w-full text-sm text-slate-500"/>
                        <small class="text-slate-400">Upload foto baru untuk menambahkan dokumentasi.</small>
                        @error('dokumentasi.*') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                    </div>

                    <div class="text-right mt-6">
                        <a href="{{ route('imunisasi.index') }}" class="inline-flex items-center px-6 py-3 mr-2 font-bold bg-gray-200 rounded-lg text-slate-700 text-xs">
                            <i class="fas fa-ban mr-2"></i> Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 font-bold text-white rounded-lg bg-gradient-to-tl from-blue-500 to-violet-500 text-xs">
                            <i class="fas fa-save mr-2"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection