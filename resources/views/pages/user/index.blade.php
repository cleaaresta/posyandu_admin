@extends('layouts.admin.app')

@section('title', 'Data User')
@section('page_title', 'Data User')

@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">

                {{-- HEADER CARD (TOMBOL TAMBAH & SEARCH) --}}
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="flex flex-wrap -mx-3 justify-between items-center">
                        <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none mb-4 md:mb-0">
                            <a href="{{ route('user.create') }}"
                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                <i class="fas fa-plus mr-1"></i> Tambah User
                            </a>
                        </div>

                        <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none">
                            <form action="{{ route('user.index') }}" method="GET"
                                class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                                <div class="flex w-full">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="pl-4 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
                                        placeholder="Cari nama atau email..." />
                                    <button type="submit"
                                        class="inline-block px-4 py-2 ml-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-slate-600 to-slate-300 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                        <i class="fas fa-search"></i>
                                    </button>

                                    @if (request('search'))
                                        <a href="{{ route('user.index') }}"
                                            class="inline-block px-4 py-2 ml-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-red-600 to-orange-600 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85"
                                            title="Reset Pencarian">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    {{-- Alert Success --}}
                    @if (session('success'))
                        <div id="success-alert" class="relative w-full p-4 pr-12 mb-4 text-white rounded-lg"
                            style="background-color: #2dce89;" role="alert">
                            <span class="font-semibold">Sukses!</span> {{ session('success') }}
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                                onclick="document.getElementById('success-alert').style.display='none'">
                                <span class="text-2xl" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Alert Error --}}
                    @if (session('error'))
                        <div id="error-alert" class="relative w-full p-4 pr-12 mb-4 text-white rounded-lg"
                            style="background-color: #ef4444;" role="alert">
                            <span class="font-semibold">Gagal!</span> {{ session('error') }}
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                                onclick="document.getElementById('error-alert').style.display='none'">
                                <span class="text-2xl" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table
                            class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        No
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Nama User
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Email
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Role
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $key => $user)
                                    <tr>
                                        <td class="p-2 align-middle border-b whitespace-nowrap">
                                            <p class="mb-0 text-xs font-semibold">{{ $key + $users->firstItem() }}</p>
                                        </td>

                                        <td class="p-2 align-middle border-b whitespace-nowrap">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    {{-- FOTO PROFIL --}}
                                                    <img src="{{ $user->foto_url }}"
                                                        class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-in-out text-sm h-9 w-9 rounded-xl object-cover border border-slate-200"
                                                        alt="user1" />
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm leading-normal dark:text-white">
                                                        {{ $user->name }}</h6>
                                                    <p
                                                        class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">
                                                        Terdaftar: {{ $user->created_at->format('d M Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-2 align-middle border-b whitespace-nowrap">
                                            <p class="mb-0 text-xs font-semibold">{{ $user->email }}</p>
                                        </td>

                                        <td class="p-2 align-middle border-b whitespace-nowrap">
                                            @php
                                                $role = trim((string) ($user->role ?? ''));
                                                if ($role === '') {
                                                    $role = 'guest';
                                                }
                                                $roleLabel = ucfirst($role);

                                                // muted badge colors (non-neon)
                                                if ($role === 'admin') {
                                                    $badgeBg = '#ecfdf5'; // green-50
                                                    $badgeBorder = '#bbf7d0'; // green-200
                                                    $textColor = '#065f46'; // green-800
                                                    $icon = 'fas fa-user-shield';
                                                } else {
                                                    $badgeBg = '#eff6ff'; // blue-50
                                                    $badgeBorder = '#bfdbfe'; // blue-200
                                                    $textColor = '#1e3a8a'; // blue-800
                                                    $icon = 'fas fa-user';
                                                }
                                            @endphp

                                            <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-lg"
                                                style="background: {{ $badgeBg }}; color: {{ $textColor }}; border: 1px solid {{ $badgeBorder }};">
                                                <i class="{{ $icon }} mr-1"
                                                    style="width:14px;text-align:center"></i>
                                                {{ $roleLabel }}
                                            </span>
                                        </td>

                                        <td class="p-2 text-center align-middle border-b whitespace-nowrap">
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                class="inline-block">
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                    class="inline-block px-3 py-1.5 mr-1 font-bold text-white rounded-lg bg-gradient-to-tl from-emerald-500 to-teal-400 text-xs">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>

                                                @csrf
                                                @method('DELETE')

                                                {{-- Tombol Hapus selalu tampil; controller menolak self-delete --}}
                                                <button type="submit"
                                                    class="inline-block px-3 py-1.5 font-bold text-white rounded-lg bg-gradient-to-tl from-red-600 to-orange-600 text-xs"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-4 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <span class="text-slate-400 mb-2"><i
                                                        class="fas fa-users-slash fa-3x"></i></span>
                                                <p class="mb-0 font-semibold">Tidak ada data User ditemukan.</p>
                                                @if (request('search'))
                                                    <p class="text-xs text-slate-400 mt-1">Coba kata kunci pencarian lain.
                                                    </p>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="flex flex-wrap justify-between items-center mt-4">
                        <div class="text-sm text-slate-500 mb-2 md:mb-0">
                            Showing <span class="font-bold">{{ $users->firstItem() ?? 0 }}</span> to <span
                                class="font-bold">{{ $users->lastItem() ?? 0 }}</span> of <span
                                class="font-bold">{{ $users->total() }}</span> results
                        </div>
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // auto-dismiss alert after 5 sec
        window.setTimeout(function() {
            const alert = document.getElementById('success-alert') || document.getElementById('error-alert');
            if (alert) {
                alert.style.transition = 'opacity 500ms ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.style.display = 'none', 500);
            }
        }, 5000);
    </script>
@endpush
