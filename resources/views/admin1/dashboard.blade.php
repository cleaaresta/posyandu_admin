<!--
...existing code...
-->
<!DOCTYPE html>
<html>

<head>
    <!-- ===== HEAD: metadata, fonts, icons, styles ===== -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/ass-admin/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('/ass-admin/img/favicon.png') }}" />
    <title>Posyandu</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('/ass-admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('/ass-admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Main Styling -->
    <link href="{{ asset('/ass-admin/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <!-- Background top color -->
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    <!-- ===== SIDENAV (left sidebar) =====
         Tambahkan komentar di sini supaya setiap bagian sidebar mudah dikenali.
         Bagian ini menampilkan logo, menu navigasi utama, account pages, dan tombol dokumentasi -->
    <aside
        class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
        aria-expanded="false">
        <!-- SIDENAV: header/logo -->
        <div class="h-19">
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden"
                sidenav-close></i>
            <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700"
                href="https://demos.creative-tim.com/argon-dashboard-tailwind/pages/dashboard.html" target="_blank">
                <img src="{{ asset('/ass-admin/img/logo-ct-dark.png') }}"
                    class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8"
                    alt="main_logo" />
                <img src="{{ asset('/ass-admin/img/logo-ct.png') }}"
                    class="hidden h-full max-w-full transition-all duration-200 dark:inline ease-nav-brand max-h-8"
                    alt="main_logo" />
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Posyandu</span>
            </a>
        </div>

        <hr
            class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

        <!-- ...existing code... -->
        <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
            <ul class="flex flex-col pl-0 mb-0">
                <!-- MENU: Dashboard -->
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 bg-blue-500/13 text-sm my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700"
                        href="{{ url('/home') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                            <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
                        </div>
                        <span class="ml-1">Dashboard</span>
                    </a>
                </li>


                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4"
                        href="{{ url('/posyandu') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                            <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-building"></i>
                        </div>
                        <span class="ml-1">Posyandu</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4 {{ request()->is('warga*') ? 'rounded-lg bg-blue-500/13 font-semibold text-slate-700' : 'text-slate-500' }}"
                        href="{{ route('warga.index') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                            <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-single-02"></i>
                        </div>
                        <span class="ml-1">Warga</span>
                    </a>
                </li>

                <!-- SIDENAV: account pages header -->
                <li class="w-full mt-4">
                    <h6 class="pl-6 ml-2 text-xs font-bold uppercase text-slate-600">Account pages</h6>
                </li>

                <!-- MENU: Profile -->
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4"
                        href="{{ url('/profile') }}">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                            <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-single-02"></i>
                        </div>
                        <span class="ml-1">Profile</span>
                    </a>
                </li>
            </ul>
        </div>



        <!-- SIDENAV: helper section at bottom (illustration + docs buttons) -->
        <div class="mx-4">
            <!-- load phantom colors for card after: -->
            <p
                class="invisible hidden text-gray-800 text-red-500 text-red-600 text-blue-500 dark:bg-white bg-slate-500 bg-gray-500/30 bg-cyan-500/30 bg-emerald-500/30 bg-orange-500/30 bg-red-500/30 after:bg-gradient-to-tl after:from-zinc-800 after:to-zinc-700 dark:bg-white">
            </p>
            <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border"
                sidenav-card>
                <img class="w-1/2 mx-auto" src="{{ asset('/ass-admin/img/illustrations/icon-documentation.svg') }}"
                    alt="sidebar illustrations" />
                <div class="flex-auto w-full p-4 pt-0 text-center">
                    <div class="transition-all duration-200 ease-nav-brand">
                        <h6 class="mb-0 dark:text-white text-slate-700">Need help?</h6>
                        <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">Please check
                            our docs</p>
                    </div>
                </div>
            </div>
            <a href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/argon-dashboard/"
                target="_blank"
                class="inline-block w-full px-8 py-2 mb-4 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-slate-700 bg-150 hover:shadow-xs hover:-translate-y-px">Documentation</a>
            <a class="inline-block w-full px-8 py-2 text-xs font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md select-none bg-150 bg-x-25 hover:shadow-xs hover:-translate-y-px"
                href="https://www.creative-tim.com/product/argon-dashboard-pro-tailwind?ref=sidebarfree"
                target="_blank">Upgrade to pro</a>
        </div>
    </aside>



    <!-- ===== MAIN CONTENT ===== -->
    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- ===== NAVBAR (top) ===== -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
            navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="text-sm leading-normal">
                            <a class="text-white opacity-50" href="javascript:;">Pages</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                            aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="mb-0 font-bold text-white capitalize">Dashboard</h6>
                </nav>

                <!-- NAVBAR: search, sign in, toggles -->
                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <div class="flex items-center md:ml-auto md:pr-4">
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                            <span
                                class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text"
                                class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
                                placeholder="Type here..." />
                        </div>
                    </div>
                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                        <!-- NAVBAR: Sign In link -->
                        <li class="flex items-center">
                            <a href="../pages/sign-in.html"
                                class="block px-0 py-2 text-sm font-semibold text-white transition-all ease-nav-brand">
                                <i class="fa fa-user sm:mr-1"></i>
                                <span class="hidden sm:inline">Sign In</span>
                            </a>
                        </li>
                        <!-- NAVBAR: responsive toggles and config -->
                        <li class="flex items-center pl-4 xl:hidden">
                            <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand"
                                sidenav-trigger>
                                <div class="w-4.5 overflow-hidden">
                                    <i
                                        class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i
                                        class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                </div>
                            </a>
                        </li>
                        <li class="flex items-center px-4">
                            <a href="javascript:;" class="p-0 text-sm text-white transition-all ease-nav-brand">
                                <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog"></i>
                            </a>
                        </li>

                        <!-- NAVBAR: notifications dropdown -->
                        <li class="relative flex items-center pr-2">
                            <p class="hidden transform-dropdown-show"></p>
                            <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand"
                                dropdown-trigger aria-expanded="false">
                                <i class="cursor-pointer fa fa-bell"></i>
                            </a>

                            <!-- notifications list -->
                            <ul dropdown-menu
                                class="text-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease lg:shadow-3xl duration-250 min-w-44 before:sm:right-8 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent dark:shadow-dark-xl dark:bg-slate-850 bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
                                <!-- add show class on dropdown open js -->
                                <li class="relative mb-2">
                                    <a class="dark:hover:bg-slate-900 ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors"
                                        href="javascript:;">
                                        <div class="flex py-1">
                                            <div class="my-auto">
                                                <img src="{{ asset('/ass-admin/img/team-2.jpg') }}"
                                                    class="inline-flex items-center justify-center mr-4 text-sm text-white h-9 w-9 max-w-none rounded-xl" />
                                            </div>
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-1 text-sm font-normal leading-normal dark:text-white">
                                                    <span class="font-semibold">New message</span> from Laur
                                                </h6>
                                                <p
                                                    class="mb-0 text-xs leading-tight text-slate-400 dark:text-white/80">
                                                    <i class="mr-1 fa fa-clock"></i>
                                                    13 minutes ago
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <!-- more notifications... -->
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- ===== CARDS / CONTENT AREA =====
           Bagian ini menampilkan kartu statistik, grafik, carousel, dan tabel.
           Saya tambahkan komentar di setiap blok kartu untuk memudahkan identifikasi. -->
        <div class="w-full px-6 py-6 mx-auto">
            <!-- row 1: 4 summary cards -->
            <div class="flex flex-wrap -mx-3">
                <!-- CARD 1: Today's Money -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Today's Money</p>
                                        <h5 class="mb-2 font-bold dark:text-white">$53,000</h5>
                                        <p class="mb-0 dark:text-white dark:opacity-60">
                                            <span class="text-sm font-bold leading-normal text-emerald-500">+55%</span>
                                            since yesterday
                                        </p>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                        <i
                                            class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: Today's Users -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Today's Users</p>
                                        <h5 class="mb-2 font-bold dark:text-white">2,300</h5>
                                        <p class="mb-0 dark:text-white dark:opacity-60">
                                            <span class="text-sm font-bold leading-normal text-emerald-500">+3%</span>
                                            since last week
                                        </p>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                                        <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: New Clients -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            New Clients</p>
                                        <h5 class="mb-2 font-bold dark:text-white">+3,462</h5>
                                        <p class="mb-0 dark:text-white dark:opacity-60">
                                            <span class="text-sm font-bold leading-normal text-red-600">-2%</span>
                                            since last quarter
                                        </p>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                                        <i
                                            class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 4: Sales -->
                <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Sales</p>
                                        <h5 class="mb-2 font-bold dark:text-white">$103,430</h5>
                                        <p class="mb-0 dark:text-white dark:opacity-60">
                                            <span class="text-sm font-bold leading-normal text-emerald-500">+5%</span>
                                            than last month
                                        </p>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                                        <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- row 2: charts and carousel -->
            <div class="flex flex-wrap mt-6 -mx-3">
                <!-- LEFT: Sales overview chart -->
                <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
                    <div
                        class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                        <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                            <h6 class="capitalize dark:text-white">Sales overview</h6>
                            <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                                <i class="fa fa-arrow-up text-emerald-500"></i>
                                <span class="font-semibold">4% more</span> in 2021
                            </p>
                        </div>
                        <div class="flex-auto p-4">
                            <div>
                                <canvas id="chart-line" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Carousel / Slide -->
                <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                    <div slider class="relative w-full h-full overflow-hidden rounded-2xl">
                        <!-- slide 1 -->
                        <div slide class="absolute w-full h-full transition-all duration-500">
                            <img class="object-cover h-full" src="{{ asset('/ass-admin/img/carousel-1.jpg') }}"
                                alt="carousel image" />
                            <div
                                class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                                <div
                                    class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                                    <i class="top-0.75 text-xxs relative text-slate-700 ni ni-camera-compact"></i>
                                </div>
                                <h5 class="mb-1 text-white">Get started with Argon</h5>
                                <p class="dark:opacity-80">There’s nothing I really wanted to do in life that I wasn’t
                                    able to get good at.</p>
                            </div>
                        </div>

                        <!-- slide 2 -->
                        <div slide class="absolute w-full h-full transition-all duration-500">
                            <img class="object-cover h-full" src="{{ asset('/ass-admin/img/carousel-2.jpg') }}"
                                alt="carousel image" />
                            <div
                                class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                                <div
                                    class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                                    <i class="top-0.75 text-xxs relative text-slate-700 ni ni-bulb-61"></i>
                                </div>
                                <h5 class="mb-1 text-white">Faster way to create web pages</h5>
                                <p class="dark:opacity-80">That’s my skill. I’m not really specifically talented at
                                    anything except for the ability to learn.</p>
                            </div>
                        </div>

                        <!-- slide 3 -->
                        <div slide class="absolute w-full h-full transition-all duration-500">
                            <img class="object-cover h-full" src="{{ asset('/ass-admin/img/carousel-3.jpg') }}"
                                alt="carousel image" />
                            <div
                                class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                                <div
                                    class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                                    <i class="top-0.75 text-xxs relative text-slate-700 ni ni-trophy"></i>
                                </div>
                                <h5 class="mb-1 text-white">Share with us your design tips!</h5>
                                <p class="dark:opacity-80">Don’t be afraid to be wrong because you can’t learn anything
                                    from a compliment.</p>
                            </div>
                        </div>

                        <!-- Carousel controls -->
                        <button btn-next
                            class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-right active:scale-110 top-6 right-4"></button>
                        <button btn-prev
                            class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-left active:scale-110 top-6 right-16"></button>
                    </div>
                </div>
            </div>

            <!-- row 3: tables and categories -->
            <div class="flex flex-wrap mt-6 -mx-3">
                <!-- LEFT: Sales by Country table -->
                <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl dark:bg-gray-950 border-black-125 rounded-2xl bg-clip-border">
                        <div class="p-4 pb-0 mb-0 rounded-t-4">
                            <div class="flex justify-between">
                                <h6 class="mb-2 dark:text-white">Sales by Country</h6>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table
                                class="items-center w-full mb-4 align-top border-collapse border-gray-200 dark:border-white/40">
                                <tbody>
                                    <!-- ROW: United States -->
                                    <tr>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap dark:border-white/40">
                                            <div class="flex items-center px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('/ass-admin/img/icons/flags/US.png') }}"
                                                        alt="Country flag" />
                                                </div>
                                                <div class="ml-6">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                        Country:</p>
                                                    <h6 class="mb-0 text-sm leading-normal dark:text-white">United
                                                        States</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                            <div class="text-center">
                                                <p
                                                    class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                    Sales:</p>
                                                <h6 class="mb-0 text-sm leading-normal dark:text-white">2500</h6>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                            <div class="text-center">
                                                <p
                                                    class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                    Value:</p>
                                                <h6 class="mb-0 text-sm leading-normal dark:text-white">$230,900</h6>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 text-sm leading-normal align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                            <div class="flex-1 text-center">
                                                <p
                                                    class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                    Bounce:</p>
                                                <h6 class="mb-0 text-sm leading-normal dark:text-white">29.9%</h6>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- other rows... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Categories list -->
                <div class="w-full max-w-full px-3 mt-0 lg:w-5/12 lg:flex-none">
                    <div
                        class="border-black/12.5 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                        <div class="p-4 pb-0 rounded-t-4">
                            <h6 class="mb-0 dark:text-white">Categories</h6>
                        </div>
                        <div class="flex-auto p-4">
                            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                <li
                                    class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-t-lg rounded-xl text-inherit">
                                    <div class="flex items-center">
                                        <div
                                            class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 rounded-xl">
                                            <i class="text-white ni ni-mobile-button relative top-0.75 text-xxs"></i>
                                        </div>
                                        <div class="flex flex-col">
                                            <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">
                                                Devices</h6>
                                            <span class="text-xs leading-tight dark:text-white/80">250 in stock, <span
                                                    class="font-semibold">346+ sold</span></span>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <button
                                            class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white"><i
                                                class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </li>

                                <!-- more categories... -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER: copyright and links -->
            <footer class="pt-4">
                <div class="w-full px-6 mx-auto">
                    <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                        <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                            <div class="text-sm leading-normal text-center text-slate-500 lg:text-left">
                                ©
                                <script>
                                    document.write(new Date().getFullYear() + ",");
                                </script>
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com"
                                    class="font-semibold text-slate-700 dark:text-white" target="_blank">Creative
                                    Tim</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 mt-0 shrink-0 lg:w-1/2 lg:flex-none">
                            <ul class="flex flex-wrap justify-center pl-0 mb-0 list-none lg:justify-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com"
                                        class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-in-out text-slate-500"
                                        target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation"
                                        class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-in-out text-slate-500"
                                        target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://creative-tim.com/blog"
                                        class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-in-out text-slate-500"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license"
                                        class="block px-4 pt-0 pb-1 pr-0 text-sm font-normal transition-colors ease-in-out text-slate-500"
                                        target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end cards -->
    </main>

    <!-- ===== FIXED PLUGIN (configurator) ===== -->
    <div fixed-plugin>
        <a fixed-plugin-button
            class="fixed px-4 py-2 text-xl bg-white shadow-lg cursor-pointer bottom-8 right-8 z-990 rounded-circle text-slate-700">
            <i class="py-2 pointer-events-none fa fa-cog"> </i>
        </a>
        <!-- plugin panel content... -->
    </div>
</body>

<!-- ===== SCRIPTS: charts, scrollbar, main ===== -->
<script src="{{ asset('/ass-admin/js/plugins/chartjs.min.js') }}" async></script>
<script src="{{ asset('/ass-admin/js/plugins/perfect-scrollbar.min.js') }}" async></script>
<script src="{{ asset('/ass-admin/js/argon-dashboard-tailwind.js?v=1.0.1') }}" async></script>

</html>
