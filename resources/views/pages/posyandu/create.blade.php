@extends('layouts.admin.app')

@section('title', 'Tambah Posyandu')
@section('page_title', 'Tambah Posyandu')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <h5 class="mb-0 dark:text-white">Formulir Tambah Posyandu</h5>
            </div>
            <div class="flex-auto p-6">
                
                <form action="{{ route('posyandu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Nama --}}
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Nama Posyandu</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        @error('nama') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" required class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">{{ old('alamat') }}</textarea>
                    </div>

                    {{-- Grid RT/RW/Kontak --}}
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0 mb-4">
                            <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">RT</label>
                            <input type="text" name="rt" value="{{ old('rt') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0 mb-4">
                            <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">RW</label>
                            <input type="text" name="rw" value="{{ old('rw') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        </div>
                        <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0 mb-4">
                            <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">No HP / Kontak</label>
                            <input type="text" name="kontak" value="{{ old('kontak') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                        </div>
                    </div>

                    <hr class="h-px my-4 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:via-white/40" />

                    {{-- Foto Profil --}}
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Foto Profil Posyandu (Opsional)</label>
                        <input type="file" name="foto_profil" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                        <small class="text-slate-400">Hanya 1 file (JPG/PNG).</small>
                    </div>

                    {{-- Galeri --}}
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Dokumentasi / Galeri Kegiatan (Opsional)</label>
                        <input type="file" name="galeri[]" multiple class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"/>
                        <small class="text-slate-400">Bisa pilih banyak foto sekaligus.</small>
                    </div>

                      <div class="text-right mt-6">
                            <a href="{{ route('posyandu.index') }}"
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
                </form>
            </div>
        </div>
    </div>
</div>
@endsection