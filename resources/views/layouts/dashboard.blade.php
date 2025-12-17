@extends('layouts.admin.app')

@section('title', 'Dashboard Posyandu')
@section('page_title', 'Dashboard')

@section('content')
    <div class="flex flex-wrap -mx-3">
        {{-- CARD 1: TOTAL WARGA --}}
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Total Warga
                                </p>
                                <h5 class="mb-2 font-bold dark:text-white">{{ $total_warga ?? 0 }}</h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">Penduduk</p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                                {{-- IKON DIGANTI: fas fa-users --}}
                                <i class="fas fa-users leading-none text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD 2: TOTAL IMUNISASI --}}
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Total Data Imunisasi
                                </p>
                                <h5 class="mb-2 font-bold dark:text-white">
                                    {{ $total_imunisasi ?? 0 }}
                                </h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    <span class="text-sm font-bold leading-normal text-emerald-500">
                                        Data
                                    </span>
                                    Tercatat
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                {{-- IKON DIGANTI: fas fa-syringe --}}
                                <i class="fas fa-syringe leading-none text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD 3: TOTAL JADWAL --}}
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Total Jadwal
                                </p>
                                <h5 class="mb-2 font-bold dark:text-white">
                                    {{ $total_jadwal ?? 0 }}
                                </h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    <span class="text-sm font-bold leading-normal text-emerald-500">
                                        Jadwal
                                    </span>
                                    Tercatat
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                                {{-- IKON DIGANTI: ni-calendar-grid-58 --}}
                                <i class="ni leading-none ni-calendar-grid-58 text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD 4: TOTAL KADER --}}
        <div class="w-full max-w-full px-3 mb-8 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Total Kader
                                </p>
                                <h5 class="mb-2 font-bold dark:text-white">
                                    {{ $total_kader ?? 0 }}
                                </h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    <span class="text-sm font-bold leading-normal text-red-600">
                                        Data
                                    </span>
                                    Kader Aktif & Non Aktif
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                                {{-- IKON DIGANTI: fas fa-user-nurse --}}
                                <i class="fas fa-user-nurse leading-none text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD 5: TOTAL LAYANAN --}}
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Total Layanan
                                </p>
                                <h5 class="mb-2 font-bold dark:text-white">
                                    {{ $total_layanan ?? 0 }}
                                </h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    <span class="text-sm font-bold leading-normal text-orange-500">
                                        Data
                                    </span>
                                    Layanan Diberikan
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                                {{-- IKON DIGANTI: fas fa-stethoscope --}}
                                <i class="fas fa-stethoscope leading-none text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD 6: DATA POSYANDU --}}
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Data Posyandu
                                </p>
                                <h5 class="mb-2 font-bold dark:text-white">{{ $total_posyandu ?? 0 }}</h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">Lokasi Terdaftar</p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                                {{-- IKON TETAP: ni-building --}}
                                <i class="ni leading-none ni-building text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD 7: TOTAL USER --}}
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Total User
                                </p>
                                <h5 class="mb-2 font-bold dark:text-white">
                                    {{ $total_user ?? 0 }}
                                </h5>
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    <span class="text-sm font-bold leading-normal text-cyan-500">Akun</span>
                                    Admin & Guest
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                {{-- IKON TETAP: ni-single-02 --}}
                                <i class="ni leading-none ni-single-02 text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   {{-- SLIDER DAN IDENTITAS PENGEMBANG --}}
    <div class="flex flex-wrap mt-6 -mx-3">

        <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
            {{-- UBAH 1: min-h dibuat responsif (250px di HP, 400px di Laptop) --}}
            <div class="relative w-full h-full overflow-hidden rounded-2xl shadow-xl min-h-[250px] md:min-h-[400px]">
                <div id="slider-carousel" class="relative w-full h-full overflow-hidden rounded-2xl">

                    {{-- SLIDE 1 --}}
                    <div class="slide absolute w-full h-full transition-all duration-500 ease-in-out opacity-100 z-10">
                        <img class="object-cover h-full w-full"
                            src="https://res.cloudinary.com/dk0z4ums3/image/upload/v1602495292/attached_image/ini-kegiatan-posyandu-dan-manfaatnya-bagi-ibu-dan-anak.jpg"
                            alt="Kegiatan Posyandu" />
                        {{-- UBAH 2: Margin teks disesuaikan untuk HP (ml-6 & right-4) --}}
                        <div class="block text-start ml-6 md:ml-12 left-0 bottom-0 absolute right-4 md:right-[15%] pt-5 pb-5 text-white bg-gradient-to-t from-black/60 to-transparent rounded-b-2xl">
                            <h5 class="mb-1 text-white text-lg md:text-xl">Ayo ke Posyandu!</h5>
                            <p class="dark:opacity-80 text-sm md:text-base">Pantau kesehatan dan tumbuh kembang anak secara rutin.</p>
                        </div>
                    </div>

                    {{-- SLIDE 2 --}}
                    <div class="slide absolute w-full h-full transition-all duration-500 ease-in-out opacity-0 z-0">
                        <img class="object-cover h-full w-full"
                            src="https://prod-swara.storage.googleapis.com/wp-content/uploads/2021/12/19220802/Screen-Shot-2021-12-20-at-18.52.57.png"
                            alt="Layanan Posyandu" />
                        <div class="block text-start ml-6 md:ml-12 left-0 bottom-0 absolute right-4 md:right-[15%] pt-5 pb-5 text-white bg-gradient-to-t from-black/60 to-transparent rounded-b-2xl">
                            <h5 class="mb-1 text-white text-lg md:text-xl">Layanan Cepat & Praktis</h5>
                            <p class="dark:opacity-80 text-sm md:text-base">Dapatkan informasi layanan Posyandu terdekat dengan satu klik.</p>
                        </div>
                    </div>

                    {{-- TOMBOL NAVIGASI --}}
                    <button onclick="nextSlide()"
                        class="absolute z-20 w-8 h-8 md:w-10 md:h-10 p-2 text-lg text-white border-none opacity-70 cursor-pointer hover:opacity-100 hover:scale-110 transition-all duration-200 top-1/2 right-2 md:right-4 -translate-y-1/2 bg-black/30 rounded-full">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <button onclick="prevSlide()"
                        class="absolute z-20 w-8 h-8 md:w-10 md:h-10 p-2 text-lg text-white border-none opacity-70 cursor-pointer hover:opacity-100 hover:scale-110 transition-all duration-200 top-1/2 right-12 md:right-16 -translate-y-1/2 bg-black/30 rounded-full">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                </div>
            </div>
        </div>

        {{-- CARD IDENTITAS PENGEMBANG --}}
        <div class="w-full max-w-full px-3 mt-6 lg:mt-0 lg:w-5/12 lg:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border h-full">
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="dark:text-white font-bold">Identitas Pengembang</h6>
                </div>
                <div class="flex-auto p-6">
                    <div class="flex flex-col items-center justify-center">

                        <div class="relative mb-4">
                            <img src="{{ asset('assets-admin/img/team/clea.jpeg') }}" alt="Foto Pengembang"
                                class="w-16 h-16 rounded-full shadow-lg border-2 border-emerald-500 object-cover">
                        </div>

                        <h5 class="mb-1 text-xl font-bold text-slate-700 dark:text-white text-center">Clearesta Rahimah Thee</h5>
                        <p class="mb-0 text-sm font-semibold text-slate-500 dark:text-white/60 text-center">NIM: 2457301029</p>
                        <p class="mb-4 text-sm text-slate-500 dark:text-white/60 text-center">D4 Sistem Informasi - Politeknik Caltex Riau</p>

                        <div class="flex w-full justify-center gap-4 mt-4">
                            {{-- GitHub --}}
                            <a href="https://github.com/cleaaresta" target="_blank" style="background-color: #1e293b;"
                                class="inline-flex items-center justify-center w-10 h-10 text-white rounded-full shadow-md transition-all duration-200 hover:shadow-lg hover:-translate-y-1">
                                <i class="fab fa-github text-lg"></i>
                            </a>

                            {{-- LinkedIn --}}
                            <a href="https://linkedin.com/in/clearesta-rahimah" target="_blank"
                                style="background-color: #0077b5;"
                                class="inline-flex items-center justify-center w-10 h-10 text-white rounded-full shadow-md transition-all duration-200 hover:shadow-lg hover:-translate-y-1">
                                <i class="fab fa-linkedin-in text-lg"></i>
                            </a>

                            {{-- Instagram --}}
                            <a href="https://www.instagram.com/cleaaresta?igsh=MWU4c3prNXhiN3BrNQ%3D%3D&utm_source=qr"
                                target="_blank" style="background-color: #E1306C;"
                                class="inline-flex items-center justify-center w-10 h-10 text-white rounded-full shadow-md transition-all duration-200 hover:shadow-lg hover:-translate-y-1">
                                <i class="fab fa-instagram text-lg"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Konfigurasi Slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide) => {
                slide.classList.remove('opacity-100', 'z-10');
                slide.classList.add('opacity-0', 'z-0');
            });
            slides[index].classList.remove('opacity-0', 'z-0');
            slides[index].classList.add('opacity-100', 'z-10');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        // Auto-play setiap 5 detik
        setInterval(nextSlide, 5000);

        // --- TAMBAHAN: FITUR SWIPE (GESER) UNTUK HP ---
        let touchStartX = 0;
        let touchEndX = 0;
        const sliderContainer = document.getElementById('slider-carousel');

        if(sliderContainer){
            sliderContainer.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            }, {passive: true});

            sliderContainer.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, {passive: true});
        }

        function handleSwipe() {
            // Jika geser ke kiri (Next)
            if (touchEndX < touchStartX - 50) nextSlide();
            // Jika geser ke kanan (Prev)
            if (touchEndX > touchStartX + 50) prevSlide();
        }
    </script>
@endsection