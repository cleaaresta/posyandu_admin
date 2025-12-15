@extends('layouts.admin.app')

@section('title', 'Edit Kader')
@section('page_title', 'Edit Data Kader')

@section('content')
<div class="flex flex-wrap -mx-3">
    {{-- Layout: w-full --}}
    <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <h5 class="mb-0 dark:text-white">Formulir Edit Kader</h5>
            </div>
            <div class="flex-auto p-6">
                
                {{-- Tampilkan Error Validasi --}}
                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700 dark:bg-red-200 dark:text-red-800" role="alert">
                        <div class="font-bold">Gagal Update!</div>
                        <ul class="list-disc pl-5 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('kader.update', $kader->kader_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    {{-- NAMA KADER --}}
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Nama Kader / Warga</label>
                        <div class="relative">
                            <select name="warga_id" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 pr-8 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none">
                                <option value="" disabled>Pilih Warga</option>
                                @foreach($wargas as $warga)
                                    <option value="{{ $warga->warga_id }}" 
                                        {{ (old('warga_id', $kader->warga_id) == $warga->warga_id) ? 'selected' : '' }}>
                                        {{ $warga->nama }} ({{ $warga->no_ktp }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-white">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- POSYANDU --}}
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Posyandu</label>
                        <div class="relative">
                            <select name="posyandu_id" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 pr-8 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none">
                                @foreach($posyandus as $posyandu)
                                    <option value="{{ $posyandu->posyandu_id }}" {{ (old('posyandu_id', $kader->posyandu_id) == $posyandu->posyandu_id) ? 'selected' : '' }}>
                                        {{ $posyandu->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-white">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Peran --}}
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Peran / Jabatan</label>
                        <input type="text" name="peran" value="{{ old('peran', $kader->peran) }}" 
                               class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none placeholder:italic placeholder:text-slate-400" />
                    </div>

                    {{-- Tanggal Tugas --}}
                    <div class="flex flex-wrap gap-4 mb-4 md:flex-nowrap">
                        <div class="w-full md:w-1/2">
                            <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Mulai Tugas</label>
                            <input type="date" name="mulai_tugas" value="{{ old('mulai_tugas', $kader->mulai_tugas ? $kader->mulai_tugas->format('Y-m-d') : '') }}" 
                                   class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none placeholder:italic placeholder:text-slate-400" />
                        </div>
                        <div class="w-full md:w-1/2">
                            <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Akhir Tugas</label>
                            <input type="date" name="akhir_tugas" value="{{ old('akhir_tugas', $kader->akhir_tugas ? $kader->akhir_tugas->format('Y-m-d') : '') }}" 
                                   class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none placeholder:italic placeholder:text-slate-400" />
                        </div>
                    </div>

                    {{-- Tombol: Tidak diubah (sesuai file kader asli) --}}
                    <div class="text-right mt-6">
                            <a href="{{ route('kader.index') }}"
                                class="inline-flex items-center justify-center px-6 py-3 mr-2 font-bold text-center uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer text-slate-700 text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                <i class="fas fa-ban mr-2"></i>
                                <span>Batal</span>
                            </a>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                <i class="fas fa-save mr-2"></i>
                                <span>Update</span>
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection