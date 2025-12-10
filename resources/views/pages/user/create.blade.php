@extends('layouts.admin.app')

@section('title', 'Tambah User')
@section('page_title', 'Tambah User')

@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                    <h5 class="mb-0 dark:text-white">Formulir Tambah User</h5>
                </div>
                <div class="flex-auto p-6">

                    {{-- PENTING: enctype="multipart/form-data" WAJIB ADA UNTUK UPLOAD FOTO --}}
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- 1. FOTO PROFIL (INPUT FILE) --}}
                        <div class="mb-4">
                            <label class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Foto Profil (Opsional)</label>
                            <div class="flex items-center gap-4">
                                <input type="file" name="foto_profil" 
                                    class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100
                                    cursor-pointer border border-slate-200 rounded-lg" />
                            </div>
                            <small class="text-slate-400 ml-1 text-xs">Format: JPG, PNG. Maks: 2MB.</small>
                            @error('foto_profil') <div class="text-red-500 text-xs italic mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- 2. Nama Lengkap --}}
                        <div class="mb-3">
                            <label for="name"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Nama
                                Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="Contoh: Admin Posyandu"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-400 focus:border-blue-500 focus:outline-none"
                                required>
                            @error('name') <div class="text-red-500 text-xs italic mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- 3. Email --}}
                        <div class="mb-3">
                            <label for="email"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Alamat
                                Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="Contoh: admin@posyandu.id"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-400 focus:border-blue-500 focus:outline-none"
                                required>
                            @error('email') <div class="text-red-500 text-xs italic mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- 4. Role (Dropdown) --}}
                        <div class="mb-3">
                            <label for="role"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Role</label>
                            <div class="relative">
                                <select name="role" required
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 pr-8 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none">
                                    <option value="">-- Pilih Role --</option>
                                    @if(isset($roles) && is_array($roles))
                                        @foreach($roles as $value => $label)
                                            <option value="{{ $value }}" {{ old('role') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    @else
                                        {{-- Fallback jika variabel roles tidak dikirim --}}
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Guest</option>
                                    @endif
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-white">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('role') <div class="text-red-500 text-xs italic mt-1">{{ $message }}</div> @enderror
                        </div>

                        <hr class="h-px my-4 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent">

                        {{-- 5. Password --}}
                        <div class="mb-3">
                            <label for="password"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Password</label>
                            <input type="password" name="password"
                                placeholder="********"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-400 focus:border-blue-500 focus:outline-none"
                                required>
                            @error('password') <div class="text-red-500 text-xs italic mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- 6. Konfirmasi Password --}}
                        <div class="mb-3">
                            <label for="password_confirmation"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Konfirmasi
                                Password</label>
                            <input type="password" name="password_confirmation"
                                placeholder="********"
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-400 focus:border-blue-500 focus:outline-none"
                                required>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="text-right mt-6">
                            <a href="{{ route('user.index') }}"
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