@extends('layouts.guest.app')

@section('title', 'Beranda - Bina Desa')
@section('page_title', 'Selamat Datang di Bina Desa')

@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Warga Terdaftar</p>
                                <h5 class="mb-2 font-bold dark:text-white">2,500</h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    <span class="text-sm font-bold leading-normal text-emerald-500">+5%</span>
                                    sejak bulan lalu
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                <i
                                    class="ni leading-none ni-single-02 text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Kepala Keluarga</p>
                                <h5 class="mb-2 font-bold dark:text-white">1,200</h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    <span class="text-sm font-bold leading-normal text-emerald-500">+2%</span>
                                    sejak minggu lalu
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                                <i class="ni leading-none ni-hat-3 text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Anak Terlayani</p>
                                <h5 class="mb-2 font-bold dark:text-white">850</h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    <span class="text-sm font-bold leading-normal text-emerald-500">+8%</span>
                                    sejak kuartal lalu
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                                <i
                                    class="ni leading-none ni-badge text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Kepuasan Masyarakat</p>
                                <h5 class="mb-2 font-bold dark:text-white">95%</h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    <span class="text-sm font-bold leading-normal text-emerald-500">+3%</span>
                                    dari tahun lalu
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                                <i class="ni leading-none ni-like-2 text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
            <div
                class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                    <h6 class="capitalize dark:text-white">Statistik Pengunjung</h6>
                    <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                        <i class="fa fa-arrow-up text-emerald-500"></i>
                        <span class="font-semibold">12% lebih banyak</span> di 2024
                    </p>
                </div>
                <div class="flex-auto p-4">
                    <div>
                        <canvas id="chart-line" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
            <div slider class="relative w-full h-full overflow-hidden rounded-2xl">
                <div slide class="absolute w-full h-full transition-all duration-500">
                    <img class="object-cover h-full" src="{{ asset('/images/posyandu.jpg') }}"
                        alt="Kegiatan Posyandu" />
                    <div
                        class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                        <div
                            class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                            <i class="top-0.75 text-xxs relative text-slate-700 ni ni-single-02"></i>
                        </div>
                        <h5 class="mb-1 text-white">Posyandu Berkala</h5>
                        <p class="dark:opacity-80">Layanan kesehatan untuk ibu dan anak dengan tenaga medis profesional.</p>
                    </div>
                </div>

                <div slide class="absolute w-full h-full transition-all duration-500">
                    <img class="object-cover h-full" src="{{ asset('/images/pendidikan.jpg') }}"
                        alt="Program Pendidikan" />
                    <div
                        class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                        <div
                            class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                            <i class="top-0.75 text-xxs relative text-slate-700 ni ni-books"></i>
                        </div>
                        <h5 class="mb-1 text-white">Program Pendidikan</h5>
                        <p class="dark:opacity-80">Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan.</p>
                    </div>
                </div>

                <div slide class="absolute w-full h-full transition-all duration-500">
                    <img class="object-cover h-full" src="{{ asset('/images/bansos.jpg') }}"
                        alt="Bantuan Sosial" />
                    <div
                        class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                        <div
                            class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                            <i class="top-0.75 text-xxs relative text-slate-700 ni ni-archive-2"></i>
                        </div>
                        <h5 class="mb-1 text-white">Bantuan Sosial</h5>
                        <p class="dark:opacity-80">Penyaluran bantuan untuk masyarakat yang membutuhkan secara transparan.</p>
                    </div>
                </div>

                <button btn-next
                    class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-right active:scale-110 top-6 right-4"></button>
                <button btn-prev
                    class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-left active:scale-110 top-6 right-16"></button>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl dark:bg-gray-950 border-black-125 rounded-2xl bg-clip-border">
                <div class="p-4 pb-0 mb-0 rounded-t-4">
                    <div class="flex justify-between">
                        <h6 class="mb-2 dark:text-white">Layanan Desa</h6>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table
                        class="items-center w-full mb-4 align-top border-collapse border-gray-200 dark:border-white/40">
                        <tbody>
                            <tr>
                                <td
                                    class="p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap dark:border-white/40">
                                    <div class="flex items-center px-2 py-1">
                                        <div>
                                            <img src="{{ asset('/images/icon-posyandu.png') }}"
                                                alt="Posyandu" />
                                        </div>
                                        <div class="ml-6">
                                            <p
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                Layanan:</p>
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">Posyandu</h6>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                    <div class="text-center">
                                        <p
                                            class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                            Peserta:</p>
                                        <h6 class="mb-0 text-sm leading-normal dark:text-white">350</h6>
                                    </div>
                                </td>
                                <td
                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                    <div class="text-center">
                                        <p
                                            class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                            Rating:</p>
                                        <h6 class="mb-0 text-sm leading-normal dark:text-white">4.8/5</h6>
                                    </div>
                                </td>
                                <td
                                    class="p-2 text-sm leading-normal align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                    <div class="flex-1 text-center">
                                        <p
                                            class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                            Status:</p>
                                        <h6 class="mb-0 text-sm leading-normal dark:text-white">Aktif</h6>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td
                                    class="p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap dark:border-white/40">
                                    <div class="flex items-center px-2 py-1">
                                        <div>
                                            <img src="{{ asset('/images/icon-pendidikan.png') }}"
                                                alt="Pendidikan" />
                                        </div>
                                        <div class="ml-6">
                                            <p
                                                class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                Layanan:</p>
                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">Pendidikan</h6>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                    <div class="text-center">
                                        <p
                                            class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                            Peserta:</p>
                                        <h6 class="mb-0 text-sm leading-normal dark:text-white">280</h6>
                                    </div>
                                </td>
                                <td
                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                    <div class="text-center">
                                        <p
                                            class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                            Rating:</p>
                                        <h6 class="mb-0 text-sm leading-normal dark:text-white">4.6/5</h6>
                                    </div>
                                </td>
                                <td
                                    class="p-2 text-sm leading-normal align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                    <div class="flex-1 text-center">
                                        <p
                                            class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                            Status:</p>
                                        <h6 class="mb-0 text-sm leading-normal dark:text-white">Aktif</h6>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mt-0 lg:w-5/12 lg:flex-none">
            <div
                class="border-black/12.5 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="p-4 pb-0 rounded-t-4">
                    <h6 class="mb-0 dark:text-white">Kategori Layanan</h6>
                </div>
                <div class="flex-auto p-4">
                    <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                        <li
                            class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-t-lg rounded-xl text-inherit">
                            <div class="flex items-center">
                                <div
                                    class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-blue-500 to-violet-500 rounded-xl">
                                    <i class="text-white ni ni-single-02 relative top-0.75 text-xxs"></i>
                                </div>
                                <div class="flex flex-col">
                                    <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">
                                        Kesehatan</h6>
                                    <span class="text-xs leading-tight dark:text-white/80">Posyandu, <span
                                            class="font-semibold">Imunisasi</span></span>
                                </div>
                            </div>
                            <div class="flex">
                                <button
                                    class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white"><i
                                        class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200"
                                        aria-hidden="true"></i></button>
                            </div>
                        </li>

                        <li
                            class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-t-lg rounded-xl text-inherit">
                            <div class="flex items-center">
                                <div
                                    class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-emerald-500 to-teal-400 rounded-xl">
                                    <i class="text-white ni ni-books relative top-0.75 text-xxs"></i>
                                </div>
                                <div class="flex flex-col">
                                    <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">
                                        Pendidikan</h6>
                                    <span class="text-xs leading-tight dark:text-white/80">Pelatihan, <span
                                            class="font-semibold">Kursus</span></span>
                                </div>
                            </div>
                            <div class="flex">
                                <button
                                    class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white"><i
                                        class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200"
                                        aria-hidden="true"></i></button>
                            </div>
                        </li>

                        <li
                            class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-t-lg rounded-xl text-inherit">
                            <div class="flex items-center">
                                <div
                                    class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-orange-500 to-yellow-500 rounded-xl">
                                    <i class="text-white ni ni-archive-2 relative top-0.75 text-xxs"></i>
                                </div>
                                <div class="flex flex-col">
                                    <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">
                                        Sosial</h6>
                                    <span class="text-xs leading-tight dark:text-white/80">Bantuan, <span
                                            class="font-semibold">Subsidi</span></span>
                                </div>
                            </div>
                            <div class="flex">
                                <button
                                    class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white"><i
                                        class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200"
                                        aria-hidden="true"></i></button>
                            </div>
                        </li>

                        </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
