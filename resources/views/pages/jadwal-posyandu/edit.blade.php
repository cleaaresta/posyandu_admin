@extends('layouts.admin.app')

@section('title', 'Edit Jadwal Posyandu')
@section('page_title', 'Edit Jadwal Posyandu')

@section('content')
<div class="flex flex-wrap -mx-3">
    {{-- Layout: w-full --}}
    <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <h5 class="mb-0 dark:text-white">Edit Jadwal</h5>
            </div>
            <div class="flex-auto p-6">

                <form action="{{ route('jadwal-posyandu.update', $jadwal->jadwal_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Posyandu</label>
                        <div class="relative">
                            <select name="posyandu_id"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 pr-8 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none">
                                @foreach ($posyandus as $posyandu)
                                    <option value="{{ $posyandu->posyandu_id }}"
                                        {{ old('posyandu_id', $jadwal->posyandu_id) == $posyandu->posyandu_id ? 'selected' : '' }}>
                                        {{ $posyandu->nama }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- Ikon Dropdown SVG --}}
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-white">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Tanggal</label>
                        <input type="date" name="tanggal"
                            value="{{ old('tanggal', $jadwal->tanggal->format('Y-m-d')) }}"
                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2 placeholder:italic placeholder:text-slate-400" />
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Tema</label>
                        <input type="text" name="tema" value="{{ old('tema', $jadwal->tema) }}"
                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2 placeholder:italic placeholder:text-slate-400" />
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80">Keterangan</label>
                        <textarea name="keterangan" rows="3"
                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 px-3 py-2 placeholder:italic placeholder:text-slate-400">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
                    </div>

                    {{-- Poster Preview --}}
                    <div class="mb-4">
                        <label class="text-xs font-bold text-slate-700 dark:text-white/80 block mb-2">Poster</label>
                        <div class="flex items-center gap-4">
                            <img src="{{ $jadwal->poster_url }}"
                                class="w-12 h-12 rounded-lg object-cover shadow-sm border border-slate-200"
                                alt="Profil">
                            <input type="file" name="poster"
                                class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700" />
                        </div>
                        <small class="text-slate-400 mt-1 block">Upload file baru untuk mengganti poster lama.</small>
                    </div>

                    {{-- Tombol: Tidak diubah (sesuai file asli) --}}
                    <div class="text-right mt-6">
                        <a href="{{ route('jadwal-posyandu.index') }}"
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