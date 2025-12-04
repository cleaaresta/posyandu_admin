@extends('layouts.admin.app')

@section('title', 'Tambah Layanan')
@section('page_title', 'Tambah Layanan Baru')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <h5 class="mb-0 dark:text-white">Formulir Pemeriksaan Kesehatan</h5>
            </div>
            <div class="flex-auto p-6">
                
                <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Pilih Jadwal --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Jadwal Kegiatan</label>
                        <select name="jadwal_id" required class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2">
                            <option value="">-- Pilih Jadwal --</option>
                            @foreach($jadwals as $jadwal)
                                <option value="{{ $jadwal->jadwal_id }}" {{ old('jadwal_id') == $jadwal->jadwal_id ? 'selected' : '' }}>
                                    {{ $jadwal->tanggal->format('d/m/Y') }} - {{ $jadwal->posyandu->nama }} ({{ $jadwal->tema }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pilih Warga --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Nama Peserta (Warga)</label>
                        <select name="warga_id" required class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2">
                            <option value="">-- Cari Nama --</option>
                            @foreach($wargas as $warga)
                                <option value="{{ $warga->warga_id }}" {{ old('warga_id') == $warga->warga_id ? 'selected' : '' }}>
                                    {{ $warga->nama }} - {{ $warga->no_ktp }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pengukuran --}}
                    <div class="flex gap-4 mb-4">
                        <div class="w-1/2">
                            <label class="text-xs font-bold text-slate-700 dark:text-white/80">Berat Badan (Kg)</label>
                            <input type="number" step="0.01" name="berat" value="{{ old('berat') }}" placeholder="0.00" required class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2" />
                        </div>
                        <div class="w-1/2">
                            <label class="text-xs font-bold text-slate-700 dark:text-white/80">Tinggi Badan (cm)</label>
                            <input type="number" step="0.1" name="tinggi" value="{{ old('tinggi') }}" placeholder="0.0" required class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2" />
                        </div>
                    </div>

                    {{-- Vitamin & Konseling --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Pemberian Vitamin (Opsional)</label>
                        <input type="text" name="vitamin" value="{{ old('vitamin') }}" placeholder="Contoh: Vitamin A Biru" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2" />
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Catatan / Konseling</label>
                        <textarea name="konseling" rows="3" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2">{{ old('konseling') }}</textarea>
                    </div>

                    {{-- Dokumentasi --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Foto Dokumentasi (Opsional)</label>
                        <input type="file" name="dokumentasi[]" multiple class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700" />
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