<aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">
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

    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
            <li class="mt-0.5 w-full">
                <a class="py-2.7 {{ Request::is('home') ? 'bg-blue-500/13' : '' }} text-sm my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700"
                    href="{{ url('/home') }}">
                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                        <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
                    </div>
                    <span class="ml-1">Dashboard</span>
                </a>
            </li>


            <li class="mt-0.5 w-full">
                <a class="py-2.7 {{ Request::is('posyandu*') ? 'bg-blue-500/13' : '' }} text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4"
                    href="{{ route('posyandu.index') }}">
                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                        <i
                            class="relative top-0 text-sm leading-normal {{ Request::is('posyandu*') ? 'text-blue-500' : 'text-slate-700' }} ni ni-building"></i>
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

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold uppercase text-slate-600">Account pages</h6>
            </li>

            <li class="mt-0.5 w-full">
                <a class="py-2.7 {{ Request::is('profile') ? 'bg-blue-500/13' : '' }} text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4"
                    href="{{ url('/profile') }}">
                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                        <i
                            class="relative top-0 text-sm leading-normal {{ Request::is('profile') ? 'text-blue-500' : 'text-slate-700' }} ni ni-single-02"></i>
                    </div>
                    <span class="ml-1">Profile</span>
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
