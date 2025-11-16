@extends('layouts.admin.app')

@section('title', 'Tambah Data Jadwal')
@section('page_title', 'Tambah Jadwal Posyandu')

@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                    <h5 class="mb-0 dark:text-white">Formulir Tambah Jadwal</h5>
                </div>
                <div class="flex-auto p-6">

                    <form action="{{ route('jadwal-posyandu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Dropdown Pilih Posyandu --}}
                        <div class="mb-3">
                            <label for="posyandu_id"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Pilih
                                Posyandu</label>
                            <select name="posyandu_id"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                required>
                                <option value="">-- Pilih Posyandu --</option>
                                @foreach ($posyandus as $posyandu)
                                    <option value="{{ $posyandu->posyandu_id }}"
                                        {{ old('posyandu_id') == $posyandu->posyandu_id ? 'selected' : '' }}>
                                        {{ $posyandu->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('posyandu_id') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tema"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Tema
                                Kegiatan</label>
                            <input type="text" name="tema" value="{{ old('tema') }}"
                                placeholder="cth: Imunisasi Polio dan Penimbangan"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                required>
                            @error('tema') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="tanggal"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Tanggal
                                Pelaksanaan</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                required>
                            @error('tanggal') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Keterangan
                                (Opsional)</label>
                            <textarea name="keterangan" rows="3" placeholder="cth: Harap membawa buku KIA..."
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">{{ old('keterangan') }}</textarea>
                            @error('keterangan') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="poster"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Poster
                                (Opsional)</label>
                            <input type="file" name="poster"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                            @error('poster') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
                        </div>

                        <div class="text-right mt-6">
                            <a href="{{ route('jadwal-posyandu.index') }}"
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