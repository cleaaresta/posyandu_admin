<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
    navbar-main navbar-scroll="false">
    <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
            <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                <li class="text-sm leading-normal">
                    <a class="text-white opacity-50" href="javascript:;">Pages</a>
                </li>
                <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                    aria-current="page">@yield('page_title', 'Page')</li>
            </ol>
            <h6 class="mb-0 font-bold text-white capitalize">@yield('page_title', 'Page')</h6>
        </nav>


        <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">

            {{-- === AWAL BAGIAN PROFIL USER === --}}
            <li class="flex items-center pl-4 lg:pl-0 mr-4">
                @auth
                    {{-- Jika Sudah Login: Tampilkan FOTO & NAMA --}}
                    <a href="{{ route('user.index') }}"
                        class="block px-0 py-2 text-sm font-semibold text-white transition-all ease-nav-brand flex items-center">

                        {{-- FOTO PROFIL --}}
                        {{-- Perhatikan class 'mr-4' di bawah ini (Margin Right 4) --}}
                        <img src="{{ auth()->user()->foto_url }}" alt="Profile"
                            class="w-8 h-8 rounded-full object-cover border-2 border-white shadow-sm mr-4">

                        {{-- NAMA USER --}}
                        <span class="hidden sm:inline">
                            {{ auth()->user()->name }}
                        </span>
                    </a>
                @else
                    {{-- Jika Belum Login (Opsional, untuk jaga-jaga) --}}
                    <a href="{{ route('login') }}"
                        class="block px-0 py-2 text-sm font-semibold text-white transition-all ease-nav-brand">
                        <i class="fa fa-user sm:mr-1"></i>
                        <span class="hidden sm:inline">Sign In</span>
                    </a>
                @endauth
            </li>
            {{-- === AKHIR BAGIAN PROFIL USER === --}}

            <li class="flex items-center">
                <form method="POST" action="{{ route('logout') }}" class="block m-0">
                    @csrf
                    <button type="submit"
                        class="flex items-center justify-center px-4 py-2 text-sm font-bold text-gray-700 transition bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer transform active:scale-90 duration-150">
                        <i class="fa fa-sign-out-alt mr-2 text-gray-500"></i>
                        <span>Sign Out</span>
                    </button>
                </form>
            </li>
            <li class="flex items-center pl-4 xl:hidden">
                <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand"
                    sidenav-trigger>
                    <div class="w-4.5 overflow-hidden">
                        <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                        <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                        <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                    </div>
                </a>
            </li>

            <li class="relative flex items-center pr-2">
                <p class="hidden transform-dropdown-show"></p>


                <ul dropdown-menu
                    class="text-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease lg:shadow-3xl duration-250 min-w-44 before:sm:right-8 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent dark:shadow-dark-xl dark:bg-slate-850 bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
                    <li class="relative mb-2">
                        <a class="dark:hover:bg-slate-900 ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors"
                            href="javascript:;">
                            <div class="flex py-1">
                                <div class="my-auto">
                                    <img src="{{ asset('/ass-admin/img/team-2.jpg') }}"
                                        class="inline-flex items-center justify-center mr-4 text-sm text-white h-9 w-9 max-w-none rounded-xl" />
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
</nav>
