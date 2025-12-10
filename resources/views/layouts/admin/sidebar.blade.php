<style>
    /* Style tambahan untuk animasi hover pada Sidebar Links */
    .sidebar-link-hover {
        transition: all 0.2s ease-in-out;
        /* Penting: Setel posisi relatif agar transform berfungsi dengan baik */
        position: relative;
    }

    .sidebar-link-hover:hover {
        /* Menggeser link sedikit ke kanan saat hover */
        transform: translateX(3px);
        /* Menambahkan shadow halus di sisi kanan */
        box-shadow: 2px 0 8px rgba(37, 117, 252, 0.2);
    }
</style>

<aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">

    {{-- POSYANDU HEADER LOGO --}}
    <div class="pt-4 pb-2">
        <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4 text-slate-700"
            href="https://demos.creative-tim.com/argon-dashboard-tailwind/pages/dashboard.html" target="_blank">
          <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-full overflow-hidden">
    <img src="{{ asset('assets-admin/img/team/logo.jpg') }}" alt="Logo Posyandu" class="w-full h-full object-cover">
</div>
            <span class="ml-1 font-semibold transition-all duration-300 ease-nav-brand">Posyandu</span>
        </a>
    </div>

    <hr
        class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">


        <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4 sidebar-link-hover {{ request()->is('home*') ? 'rounded-lg bg-blue-500/13 font-semibold text-slate-700' : 'text-slate-500' }}"
                href="{{ url('/home') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                    <i
                        class="relative top-0 text-sm leading-normal {{ request()->is('home*') ? 'text-blue-500' : 'text-slate-700' }} ni ni-tv-2"></i>
                </div>
                <span class="ml-1">Dashboard</span>
            </a>
        </li>


        {{-- JUDUL KATEGORI: Fitur Utama --}}
        <h6 class="pl-6 ml-2 mt-4 mb-2 text-xs font-bold uppercase text-slate-600">Fitur Utama</h6>

        <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 sidebar-link-hover transition-colors dark:text-white dark:opacity-80
    {{ request()->routeIs('kader.*') ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }}"
                href="{{ route('kader.index') }}">
                <div
                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                    <i class="fas fa-user-nurse text-slate-800 text-sm"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Kader Posyandu</span>
            </a>
        </li>
        <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 sidebar-link-hover transition-colors dark:text-white dark:opacity-80
            {{ request()->routeIs('imunisasi.*') ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }}"
                href="{{ route('imunisasi.index') }}">
                <div
                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                    <i class="fas fa-syringe text-slate-800 text-sm"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Catatan Imunisasi</span>
            </a>
        </li>
        <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4 sidebar-link-hover {{ request()->is('jadwal-posyandu*') ? 'rounded-lg bg-blue-500/13 font-semibold text-slate-700' : 'text-slate-500' }}"
                href="{{ route('jadwal-posyandu.index') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                    <i
                        class="relative top-0 text-sm leading-normal {{ request()->is('jadwal-posyandu*') ? 'text-blue-500' : 'text-slate-700' }} ni ni-calendar-grid-58"></i>
                </div>
                <span class="ml-1">Jadwal Posyandu</span>
            </a>
        </li>

        <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 sidebar-link-hover transition-colors dark:text-white dark:opacity-80
         {{ request()->routeIs('layanan.*') ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }}"
                href="{{ route('layanan.index') }}">
                <div
                    class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                    <i class="fas fa-stethoscope text-slate-800 text-sm"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Layanan Posyandu</span>
            </a>
        </li>

        <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4 sidebar-link-hover {{ request()->is('posyandu*') ? 'rounded-lg bg-blue-500/13 font-semibold text-slate-700' : 'text-slate-500' }}"
                href="{{ url('/posyandu') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                    <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-building"></i>
                </div>
                <span class="ml-1">Posyandu</span>
            </a>
        </li>

        {{-- JUDUL KATEGORI: Master Data --}}
        <h6 class="pl-6 ml-2 mt-4 mb-2 text-xs font-bold uppercase text-slate-600">Master Data</h6>

        <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4 sidebar-link-hover {{ request()->is('user*') ? 'rounded-lg bg-blue-500/13 font-semibold text-slate-700' : 'text-slate-500' }}"
                href="{{ route('user.index') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg">
                    <i
                        class="relative top-0 text-sm leading-normal {{ request()->is('user*') ? 'text-blue-500' : 'text-slate-700' }} ni ni-single-02"></i>
                </div>
                <span class="ml-1">User</span>
            </a>
        </li>

        <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm my-0 mx-2 flex items-center whitespace-nowrap px-4 sidebar-link-hover {{ request()->is('warga*') ? 'rounded-lg bg-blue-500/13 font-semibold text-slate-700' : 'text-slate-500' }}"
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
</aside>