@extends('layouts.admin.app')

@section('title', 'Edit Data Posyandu')
@section('page_title', 'Edit Posyandu')

@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                    <h5 class="mb-0 dark:text-white">Formulir Edit: {{ $posyandu->nama }}</h5>
                </div>
                <div class="flex-auto p-6">

                    {{-- Menambahkan @method('PUT') dan enctype --}}
                    <form action="{{ route('posyandu.update', $posyandu->posyandu_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Nama
                                Posyandu</label>
                            <input type="text" name="nama"
                                value="{{ old('nama', $posyandu->nama) }}" {{-- Mengisi data lama --}}
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                required>
                            @error('nama') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Alamat</label>
                            <textarea name="alamat" rows="3"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                required>{{ old('alamat', $posyandu->alamat) }}</textarea> {{-- Mengisi data lama --}}
                            @error('alamat') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
                        </div>

                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-3">
                                    <label for="rt"
                                        class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">RT</label>
                                    <input type="text" name="rt" value="{{ old('rt', $posyandu->rt) }}"
                                        class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                <div class="mb-3">
                                    <label for="rw"
                                        class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">RW</label>
                                    <input type="text" name="rw" value="{{ old('rw', $posyandu->rw) }}"
                                        class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="kontak"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Kontak
                                (No. Telepon)</label>
                            <input type="text" name="kontak" value="{{ old('kontak', $posyandu->kontak) }}"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                        </div>

                        <div class="mb-3">
                            <label for="foto"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Foto
                                (Opsional)</label>

                            {{-- Menampilkan foto saat ini --}}
                            @if ($posyandu->foto)
                                <div class="my-2">
                                    <img src="{{ asset('storage/posyandu_fotos/' . $posyandu->foto) }}" alt="Foto Saat Ini"
                                        class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif

                            <input type="file" name="foto"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                            <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengubah foto.</p>
                            @error('foto') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
                        </div>

                        <div class="text-right mt-6">
                            {{-- 
                              ==================================================================
                              PERUBAHAN DI SINI (Tombol Batal):
                              - Menambahkan `inline-flex items-center justify-center`
                              - Menambahkan tag <i> untuk ikon `fa-ban`
                              ==================================================================
                            --}}
                            <a href="{{ route('posyandu.index') }}"
                                class="inline-flex items-center justify-center px-6 py-3 mr-2 font-bold text-center uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer text-slate-700 text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                <i class="fas fa-ban mr-2"></i>
                                <span>Batal</span>
                            </a>
                            
                            {{-- 
                              ==================================================================
                              PERUBAHAN DI SINI (Tombol Update):
                              - Menambahkan `inline-flex items-center justify-center`
                              - Menambahkan tag <i> untuk ikon `fa-save`
                              ==================================================================
                            --}}
                            <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                <i class="fas fa-save mr-2"></i>
                                <span>Update</span>
                            </button>
                            {{-- ================================================================== --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection