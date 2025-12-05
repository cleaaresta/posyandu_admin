@extends('layouts.admin.app')

@section('title', 'Edit Pemeriksaan & Layanan')
@section('page_title', 'Edit Pemeriksaan & Layanan')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <h5 class="mb-0 dark:text-white">Edit Pemeriksaan</h5>
            </div>
            <div class="flex-auto p-6">
                <form action="{{ route('layanan.update', $layanan->layanan_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    
                    {{-- Jadwal (Dengan Ikon) --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700">Jadwal</label>
                        <div class="relative">
                            <select name="jadwal_id" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2 pr-8 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none">
                                @foreach($jadwals as $jadwal)
                                    <option value="{{ $jadwal->jadwal_id }}" {{ $layanan->jadwal_id == $jadwal->jadwal_id ? 'selected' : '' }}>
                                        {{ $jadwal->tanggal->format('d/m/Y') }} - {{ $jadwal->posyandu->nama }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- Ikon SVG --}}
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-white">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Nama Warga (Dengan Ikon) --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700">Nama Warga</label>
                        <div class="relative">
                            <select name="warga_id" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2 pr-8 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none">
                                @foreach($wargas as $warga)
                                    <option value="{{ $warga->warga_id }}" {{ $layanan->warga_id == $warga->warga_id ? 'selected' : '' }}>
                                        {{ $warga->nama }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- Ikon SVG --}}
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-white">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 mb-4">
                        <div class="w-1/2">
                            <label class="text-xs font-bold text-slate-700">Berat (Kg)</label>
                            <input type="number" step="0.01" name="berat" value="{{ $layanan->berat }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2" />
                        </div>
                        <div class="w-1/2">
                            <label class="text-xs font-bold text-slate-700">Tinggi (cm)</label>
                            <input type="number" step="0.1" name="tinggi" value="{{ $layanan->tinggi }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700">Vitamin</label>
                        <input type="text" name="vitamin" value="{{ $layanan->vitamin }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2" />
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700">Konseling</label>
                        <textarea name="konseling" rows="3" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2">{{ $layanan->konseling }}</textarea>
                    </div>

                    {{-- Galeri --}}
                    <div class="mb-6">
                        <label class="text-xs font-bold text-slate-700 block mb-2">Dokumentasi</label>
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($layanan->dokumentasi as $media)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $media->file_url) }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200 shadow-sm">
                                    <a href="{{ route('media.delete.layanan', $media->media_id) }}" 
                                       onclick="return confirm('Hapus foto ini?')"
                                       class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                       <i class="fas fa-times"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <input type="file" name="dokumentasi[]" multiple class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-violet-50 file:text-violet-700"/>
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
                                <span>Update</span>
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection