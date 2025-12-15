@extends('layouts.admin.app')

@section('title', 'Edit Data Imunisasi')
@section('page_title', 'Edit Data Imunisasi')

@section('content')
    <div class="flex flex-wrap -mx-3">
        {{-- Layout: w-full --}}
        <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                    <h5 class="mb-0 dark:text-white">Edit Catatan Imunisasi</h5>
                </div>
                <div class="flex-auto p-6">

                    <form action="{{ route('imunisasi.update', $imunisasi->imunisasi_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Pilih Warga --}}
                        <div class="mb-4">
                            <label class="text-xs font-bold text-slate-700 dark:text-white/80 mb-2 inline-block">Nama
                                Warga</label>
                            <select name="warga_id"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2">
                                @foreach ($wargas as $warga)
                                    <option value="{{ $warga->warga_id }}"
                                        {{ old('warga_id', $imunisasi->warga_id) == $warga->warga_id ? 'selected' : '' }}>
                                        {{ $warga->nama }} - {{ $warga->no_ktp ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('warga_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Jenis Vaksin --}}
                        <div class="mb-4">
                            <label class="text-xs font-bold text-slate-700 dark:text-white/80 mb-2 inline-block">Jenis
                                Vaksin</label>
                            <input type="text" name="jenis_vaksin"
                                value="{{ old('jenis_vaksin', $imunisasi->jenis_vaksin) }}"
                                placeholder="Contoh: Polio, Campak, COVID-19"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2 placeholder:italic placeholder:text-slate-400" />
                            @error('jenis_vaksin')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Grid 2 Kolom --}}
                        <div class="flex flex-wrap gap-4 mb-4 md:flex-nowrap">
                            <div class="w-full md:w-1/2">
                                <label
                                    class="text-xs font-bold text-slate-700 dark:text-white/80 mb-2 inline-block">Tanggal</label>
                                <input type="date" name="tanggal"
                                    value="{{ old('tanggal', $imunisasi->tanggal ? $imunisasi->tanggal->format('Y-m-d') : '') }}"
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2 placeholder:italic placeholder:text-slate-400" />
                                @error('tanggal')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2">
                                <label class="text-xs font-bold text-slate-700 dark:text-white/80 mb-2 inline-block">Tenaga
                                    Kesehatan</label>
                                <input type="text" name="nakes" value="{{ old('nakes', $imunisasi->nakes) }}"
                                    placeholder="Nama Bidan/Dokter"
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2 placeholder:italic placeholder:text-slate-400" />
                                @error('nakes')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Lokasi --}}
                        <div class="mb-4">
                            <label
                                class="text-xs font-bold text-slate-700 dark:text-white/80 mb-2 inline-block">Lokasi</label>
                            <input type="text" name="lokasi" value="{{ old('lokasi', $imunisasi->lokasi) }}"
                                placeholder="Contoh: Posyandu Mawar, Puskesmas"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-solid border-gray-300 px-3 py-2 placeholder:italic placeholder:text-slate-400" />
                            @error('lokasi')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Dokumentasi --}}
                        <div class="mb-6">
                            <label class="text-xs font-bold text-slate-700 mb-2 block dark:text-white/80">Dokumentasi Saat
                                Ini</label>

                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach ($imunisasi->dokumentasi as $media)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $media->file_url) }}"
                                            class="w-12 h-12 rounded-lg object-cover border border-slate-200 shadow-sm">

                                        {{-- Hapus Media --}}
                                        <a href="{{ route('media.delete.imunisasi', $media->media_id) }}"
                                            onclick="return confirm('Hapus foto ini?')"
                                            class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <input type="file" name="dokumentasi[]" multiple
                                class="block w-full text-sm text-slate-500" />
                            <small class="text-slate-400 italic mt-1 block">Upload foto baru untuk menambahkan
                                dokumentasi.</small>
                            @error('dokumentasi.*')
                                <span class="text-red-500 text-xs block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Tombol: KEMBALI KE ASLI (Persis file edit.blade.php awal) --}}
                        <div class="text-right mt-6">
                            <div class="text-right mt-6">
                                <a href="{{ route('imunisasi.index') }}"
                                    class="inline-flex items-center justify-center px-6 py-3 mr-2 font-bold text-center uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer text-slate-700 text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                    <i class="fas fa-ban mr-2"></i>
                                    <span>Batal</span>
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center justify-center px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                    <i class="fas fa-save mr-2"></i>
                                    <span>Simpan</span>
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        @endsection
