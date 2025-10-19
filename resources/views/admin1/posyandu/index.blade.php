<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/ass-admin/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('/ass-admin/img/favicon.png') }}" />
    <title>Data Posyandu</title>
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
                    <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Posyandu</li>
                </ol>
                <h6 class="mb-0 font-bold text-white capitalize">Data Posyandu</h6>
            </nav>

            <div class="flex flex-wrap mt-6 -mx-3">
                <div class="w-full max-w-full px-3">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="p-6">
                            <a href="{{ route('posyandu.create') }}" class="inline-block px-6 py-3 mb-4 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-blue-500 to-violet-500 leading-normal text-xs ease-in tracking-tight-rem shadow-xs bg-150 bg-x-25 hover:-translate-y-px active:opacity-85">
                                Tambah Data Posyandu
                            </a>

                            @if (session('success'))
                                <div class="relative w-full p-4 mb-4 text-white bg-green-500 rounded-lg" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Foto</th>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Posyandu</th>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Alamat</th>
                                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Kontak</th>
                                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($posyandus as $posyandu)
                                        <tr>
                                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                @if($posyandu->foto)
                                                    <img src="{{ asset('storage/posyandu_fotos/' . $posyandu->foto) }}" class="w-16 h-16 object-cover rounded" alt="Foto Posyandu">
                                                @else
                                                    <span class="text-xs">Tidak ada foto</span>
                                                @endif
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $posyandu->nama }}</h6>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">{{ Str::limit($posyandu->alamat, 50) }}</p>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">{{ $posyandu->kontak }}</p>
                                            </td>
                                            <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <a href="{{ route('posyandu.edit', $posyandu->posyandu_id) }}" class="text-xs font-semibold leading-tight text-slate-400"> Edit </a>

                                                <form action="{{ route('posyandu.destroy', $posyandu->posyandu_id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-xs font-semibold leading-tight text-red-500" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"> Hapus </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 font-semibold leading-tight dark:text-white dark:opacity-60">Tidak ada data.</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin1.partials.footer')
        </div>
    </main>

    <div fixed-plugin>
        </div>
</body>

<script src="{{ asset('/ass-admin/js/plugins/chartjs.min.js') }}" async></script>
<script src="{{ asset('/ass-admin/js/plugins/perfect-scrollbar.min.js') }}" async></script>
<script src="{{ asset('/ass-admin/js/argon-dashboard-tailwind.js?v=1.0.1') }}" async></script>
</html>
