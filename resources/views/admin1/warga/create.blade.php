<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/ass-admin/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('/ass-admin/img/favicon.png') }}" />
    <title>Tambah Warga</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('/ass-admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('/ass-admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <link href="{{ asset('/ass-admin/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
</head>

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    @include('admin1.partials.sidebar')

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">

        @include('admin1.partials.navbar')

        <div class="w-full px-6 py-6 mx-auto">
            <nav>
                <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                    <li class="text-sm leading-normal"><a class="text-white opacity-50" href="{{ url('/home') }}">Pages</a></li>
                    <li class="text-sm leading-normal text-white opacity-50 before:float-left before:pr-2 before:text-white before:content-['/']"><a href="{{ route('warga.index') }}">Warga</a></li>
                    <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Tambah Data</li>
                </ol>
                <h6 class="mb-0 font-bold text-white capitalize">Tambah Data Warga</h6>
            </nav>

            <div class="flex flex-wrap mt-6 -mx-3">
                <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <h5 class="mb-0 dark:text-white">Formulir Tambah Warga</h5>
                        </div>
                        <div class="flex-auto p-6">

                            <form action="{{ route('warga.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="no_ktp" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">No. KTP</label>
                                    <input type="text" name="no_ktp" value="{{ old('no_ktp') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" required>
                                    @error('no_ktp') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nama" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Nama Lengkap</label>
                                    <input type="text" name="nama" value="{{ old('nama') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" required>
                                    @error('nama') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" required>
                                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="agama" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Agama</label>
                                    <input type="text" name="agama" value="{{ old('agama') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                </div>

                                <div class="mb-3">
                                    <label for="pekerjaan" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Pekerjaan</label>
                                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                </div>

                                <div class="mb-3">
                                    <label for="telp" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">No. Telepon</label>
                                    <input type="text" name="telp" value="{{ old('telp') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 dark:text-white/80">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                </div>

                                <div class="text-right mt-6">
                                    <a href="{{ route('warga.index') }}" class="inline-block px-6 py-3 mr-2 font-bold text-center uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer text-slate-700 text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">Batal</a>
                                    <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin1.partials.footer')
        </div>
    </main>

    <div fixed-plugin></div>
</body>
<script src="{{ asset('/ass-admin/js/plugins/chartjs.min.js') }}" async></script>
<script src="{{ asset('/ass-admin/js/plugins/perfect-scrollbar.min.js') }}" async></script>
<script src="{{ asset('/ass-admin/js/argon-dashboard-tailwind.js?v=1.0.1') }}" async></script>
</html>
