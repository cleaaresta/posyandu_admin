<aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">
    <div class="h-19">
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700"
            href="https://demos.creative-tim.com/argon-dashboard-tailwind/pages/dashboard.html" target="_blank">
            <svg class="inline transition-all duration-200 ease-nav-brand max-h-8 mr-2" width="32" height="32"
                viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                style="position: relative; top: -2px;">
                <!-- Latar belakang Lingkaran Biru -->
                <circle cx="16" cy="16" r="15" fill="#2575FC" />
                <!-- Simbol Palang Merah / Hati Putih -->
                <path
                    d="M16 8C11.5817 8 8 11.5817 8 16C8 20.4183 11.5817 24 16 24C20.4183 24 24 20.4183 24 16C24 11.5817 20.4183 8 16 8ZM16 22.4C12.464 22.4 9.6 19.536 9.6 16C9.6 12.464 12.464 9.6 16 9.6C19.536 9.6 22.4 12.464 22.4 16C22.4 19.536 19.536 22.4 16 22.4ZM16.8 12.8H15.2V15.2H12.8V16.8H15.2V19.2H16.8V16.8H19.2V15.2H16.8V12.8Z"
                    fill="white" />
            </svg>
            <span class="ml-1 font-semibold transition-all duration-300 ease-nav-brand">Posyandu</span>
        </a>
    </div>

    <hr
        class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold uppercase text-slate-600">Fitur Utama</h6>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4 {{ request()->is('home*') ? 'rounded-lg bg-blue-500/13 font-semibold text-slate-700' : 'text-slate-500' }}"
                    href="{{ url('/home') }}">
                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                        <i
                            class="relative top-0 text-sm leading-normal {{ request()->is('home*') ? 'text-blue-500' : 'text-slate-700' }} ni ni-tv-2"></i>
                    </div>
                    <span class="ml-1">Dashboard</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4 {{ request()->is('posyandu*') ? 'rounded-lg bg-blue-500/13 font-semibold text-slate-700' : 'text-slate-500' }}"
                    href="{{ url('/posyandu') }}">
                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                        <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-building"></i>
                    </div>
                    <span class="ml-1">Posyandu</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4 {{ request()->is('jadwal-posyandu*') ? 'rounded-lg bg-blue-500/13 font-semibold text-slate-700' : 'text-slate-500' }}"
                    href="{{ route('jadwal-posyandu.index') }}">
                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                        <i
                            class="relative top-0 text-sm leading-normal {{ request()->is('jadwal-posyandu*') ? 'text-blue-500' : 'text-slate-700' }} ni ni-calendar-grid-58"></i>
                    </div>
                    <span class="ml-1">Jadwal Posyandu</span>
                </a>
            </li>

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold uppercase text-slate-600">Master Data</h6>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4 {{ request()->is('user*') ? 'rounded-lg bg-blue-500/13 font-semibold text-slate-700' : 'text-slate-500' }}"
                    href="{{ route('user.index') }}">
                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                        <i
                            class="relative top-0 text-sm leading-normal {{ request()->is('user*') ? 'text-blue-500' : 'text-slate-700' }} ni ni-single-02"></i>
                    </div>
                    <span class="ml-1">User</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4 {{ request()->is('warga*') ? 'rounded-lg bg-blue-500/13 font-semibold text-slate-700' : 'text-slate-500' }}"
                    href="{{ route('warga.index') }}">
                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                        <i
                            class="relative top-0 text-sm leading-normal {{ request()->is('warga*') ? 'text-blue-500' : 'text-slate-700' }} fas fa-users"></i>
                    </div>
                    <span class="ml-1">Warga</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="mx-4">
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
        <a href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/argon-dashboard/" target="_blank"
            class="inline-block w-full px-8 py-2 mb-4 text-xs font-bold leading-normal text-center text-white capitalize transition-all ease-in rounded-lg shadow-md bg-slate-700 bg-150 hover:shadow-xs hover:-translate-y-px">Documentation</a>
        <a class="inline-block w-full px-8 py-2 text-xs font-bold leading-normal text-center text-white align-middle transition-all ease-in bg-blue-500 border-0 rounded-lg shadow-md select-none bg-150 bg-x-25 hover:shadow-xs hover:-translate-y-px"
            href="https://www.creative-tim.com/product/argon-dashboard-pro-tailwind?ref=sidebarfree"
            target="_blank">Upgrade to pro</a>
    </div>
</aside>
