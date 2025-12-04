@extends('layouts.admin.app')

@section('title', 'Edit Kader')
@section('page_title', 'Edit Data Kader')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <h5 class="mb-0 dark:text-white">Formulir Edit Kader</h5>
            </div>
            <div class="flex-auto p-6">
                
                <form action="{{ route('kader.update', $kader->kader_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    {{-- Nama (Disabled karena tidak boleh ganti orang) --}}
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Nama Kader</label>
                        <input type="text" value="{{ $kader->warga->nama }} ({{ $kader->warga->no_ktp }})" disabled class="bg-gray-100 dark:bg-slate-700 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2 font-normal text-gray-700 outline-none" />
                        <input type="hidden" name="warga_id" value="{{ $kader->warga_id }}">
                    </div>

                    {{-- Posyandu --}}
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Posyandu</label>
                        <select name="posyandu_id" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none">
                            @foreach($posyandus as $posyandu)
                                <option value="{{ $posyandu->posyandu_id }}" {{ $kader->posyandu_id == $posyandu->posyandu_id ? 'selected' : '' }}>
                                    {{ $posyandu->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Peran --}}
                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Peran / Jabatan</label>
                        <input type="text" name="peran" value="{{ old('peran', $kader->peran) }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none" />
                    </div>

                    {{-- Tanggal Tugas --}}
                    <div class="flex gap-4 mb-4">
                        <div class="w-1/2">
                            <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Mulai Tugas</label>
                            <input type="date" name="mulai_tugas" value="{{ old('mulai_tugas', $kader->mulai_tugas ? $kader->mulai_tugas->format('Y-m-d') : '') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none" />
                        </div>
                        <div class="w-1/2">
                            <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Akhir Tugas</label>
                            <input type="date" name="akhir_tugas" value="{{ old('akhir_tugas', $kader->akhir_tugas ? $kader->akhir_tugas->format('Y-m-d') : '') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none" />
                        </div>
                    </div>

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