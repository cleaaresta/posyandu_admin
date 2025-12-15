@extends('layouts.admin.app')

@section('title', 'Tambah Layanan')
@section('page_title', 'Tambah Layanan Baru')

@section('content')
<div class="flex flex-wrap -mx-3">
    {{-- Layout: w-full agar mengisi penuh --}}
    <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <h5 class="mb-0 dark:text-white">Formulir Pemeriksaan Kesehatan</h5>
            </div>
            <div class="flex-auto p-6">
                
                {{-- Hapus enctype="multipart/form-data" karena tidak ada upload file --}}
                <form action="{{ route('layanan.store') }}" method="POST">
                    @csrf
                    
                    {{-- Pilih Jadwal --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Jadwal Kegiatan</label>
                        <div class="relative">
                            <select name="jadwal_id" required class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2 pr-8 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none">
                                <option value="">-- Pilih Jadwal --</option>
                                @foreach($jadwals as $jadwal)
                                    <option value="{{ $jadwal->jadwal_id }}" {{ old('jadwal_id') == $jadwal->jadwal_id ? 'selected' : '' }}>
                                        {{ $jadwal->tanggal->format('d/m/Y') }} - {{ $jadwal->posyandu->nama }} ({{ $jadwal->tema }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-white">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Pilih Warga --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Nama Peserta (Warga)</label>
                        <div class="relative">
                            <select name="warga_id" required class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2 pr-8 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none">
                                <option value="">-- Cari Nama --</option>
                                @foreach($wargas as $warga)
                                    <option value="{{ $warga->warga_id }}" {{ old('warga_id') == $warga->warga_id ? 'selected' : '' }}>
                                        {{ $warga->nama }} - {{ $warga->no_ktp }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-white">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Pengukuran --}}
                    <div class="flex flex-wrap gap-4 mb-4 md:flex-nowrap">
                        <div class="w-full md:w-1/2">
                            <label class="text-xs font-bold text-slate-700 dark:text-white/80">Berat Badan (Kg)</label>
                            <input type="number" step="0.01" name="berat" value="{{ old('berat') }}" 
                                   placeholder="0.00" required 
                                   class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2 placeholder:italic placeholder:text-slate-400" />
                        </div>
                        <div class="w-full md:w-1/2">
                            <label class="text-xs font-bold text-slate-700 dark:text-white/80">Tinggi Badan (cm)</label>
                            <input type="number" step="0.1" name="tinggi" value="{{ old('tinggi') }}" 
                                   placeholder="0.0" required 
                                   class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2 placeholder:italic placeholder:text-slate-400" />
                        </div>
                    </div>

                    {{-- Vitamin & Konseling --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Pemberian Vitamin (Opsional)</label>
                        <input type="text" name="vitamin" value="{{ old('vitamin') }}" 
                               placeholder="Contoh: Vitamin A Biru" 
                               class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2 placeholder:italic placeholder:text-slate-400" />
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Catatan / Konseling</label>
                        <textarea name="konseling" rows="3" 
                                  placeholder="Catatan hasil pemeriksaan..." 
                                  class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2 placeholder:italic placeholder:text-slate-400">{{ old('konseling') }}</textarea>
                    </div>

                    <div class="text-right mt-6">
                        <a href="{{ route('layanan.index') }}"
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