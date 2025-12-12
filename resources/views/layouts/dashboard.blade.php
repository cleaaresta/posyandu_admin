@extends('layouts.admin.app')

@section('title', 'Dashboard Posyandu')
@section('page_title', 'Dashboard')

@section('content')
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
<div>
                        <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                            Total Warga
                        </p>
                        <h5 class="mb-2 font-bold dark:text-white">{{ $total_warga ?? 0 }}</h5>
                        <p class="mb-0 dark:text-white dark:opacity-60">Penduduk</p>
                    </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                        <i class="ni leading-none ni-satisfied text-lg relative top-3.5 text-white"></i>
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
                                    Total Data Imunisasi
                                </p>

                                {{-- Ini akan menampilkan angka dari database --}}
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
                                <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
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
                                {{-- LABEL --}}
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Total Jadwal
                                </p>

                                {{-- ANGKA DINAMIS --}}
                                <h5 class="mb-2 font-bold dark:text-white">
                                    {{ $total_jadwal ?? 0 }}
                                </h5>

                                {{-- SUB-LABEL --}}
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
                                <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mb-8 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                {{-- LABEL --}}
                                <p
                                    class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                    Total Kader
                                </p>

                                {{-- ANGKA DINAMIS (Dari Database) --}}
                                <h5 class="mb-2 font-bold dark:text-white">
                                    {{ $total_kader ?? 0 }}
                                </h5>

                                {{-- SUB-LABEL --}}
                                <p class="mb-0 dark:text-white dark:opacity-60">
                                    <span class="text-sm font-bold leading-normal text-red-600">
                                        Data
                                    </span>
                                    Kader Aktif
                                </p>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                                <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
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
                                <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                            Total Layanan
                        </p>
                        <h5 class="mb-2 font-bold dark:text-white">
                            {{ $total_layanan ?? 0 }}
                        </h5>
                        <p class="mb-0 dark:text-white dark:opacity-60">
                            <span class="text-sm font-bold leading-normal text-orange-500">
                                Data
                            </span>
                            Pemeriksaan
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

        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                        <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                            Data Posyandu
                        </p>
                        <h5 class="mb-2 font-bold dark:text-white">{{ $total_posyandu ?? 0 }}</h5>
                        <p class="mb-0 dark:text-white dark:opacity-60">Lokasi Terdaftar</p>
                    </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                        <i class="ni leading-none ni-building text-lg relative top-3.5 text-white"></i>
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
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                Total User
                            </p>
                            <h5 class="mb-2 font-bold dark:text-white">
                                {{ $total_user ?? 0 }}
                            </h5>
                            <p class="mb-0 dark:text-white dark:opacity-60">
                                <span class="text-sm font-bold leading-normal text-cyan-500">Akun</span>
                                Admin
                            </p>
                        </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div
                                class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                <i class="ni leading-none ni-single-02 text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    

    

    

    

    


    <div class="flex flex-wrap mt-6 -mx-3">
       
        <div class="w-full max-w-full px-3 mt-0 lg:w-5/12 lg:flex-none">
            <div
                       
                
                    
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap mt-6 -mx-3">

        <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
    <div class="relative w-full h-full overflow-hidden rounded-2xl shadow-xl min-h-[400px]">
        <div id="slider-carousel" class="relative w-full h-full overflow-hidden rounded-2xl">

            <div class="slide absolute w-full h-full transition-all duration-500 ease-in-out opacity-100 z-10">
                <img class="object-cover h-full w-full" 
                     src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=800&q=60"
                     alt="Bali Indonesia" />
                <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                    <h5 class="mb-1 text-white">Pesona Bali</h5>
                    <p class="dark:opacity-80">Menikmati keindahan Pura Ulun Danu Beratan.</p>
                </div>
            </div>

            <div class="slide absolute w-full h-full transition-all duration-500 ease-in-out opacity-0 z-0">
                <img class="object-cover h-full w-full" 
                     src="https://upload.wikimedia.org/wikipedia/commons/b/bf/Busway_in_Bundaran_HI.jpg"
                     alt="Jakarta City" />
                <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                    <h5 class="mb-1 text-white">Metropolitan Jakarta</h5>
                    <p class="dark:opacity-80">Pusat bisnis dan pemerintahan Indonesia.</p>
                </div>
            </div>

            <div class="slide absolute w-full h-full transition-all duration-500 ease-in-out opacity-0 z-0">
                <img class="object-cover h-full w-full" 
                     src="https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=800&q=60"
                     alt="Bromo Mountain" />
                <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                    <h5 class="mb-1 text-white">Gunung Bromo</h5>
                    <p class="dark:opacity-80">Keajaiban alam Jawa Timur yang memukau dunia.</p>
                </div>
            </div>

            <button onclick="nextSlide()" 
                    class="absolute z-20 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 hover:scale-110 transition-all duration-200 top-1/2 right-4 -translate-y-1/2">
                <i class="fas fa-chevron-right"></i>
            </button>
            <button onclick="prevSlide()" 
                    class="absolute z-20 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 hover:scale-110 transition-all duration-200 top-1/2 right-16 -translate-y-1/2">
                <i class="fas fa-chevron-left"></i>
            </button>
            
        </div>
    </div>
</div>

        <div class="w-full max-w-full px-3 mt-0 lg:w-5/12 lg:flex-none">
            <div
                class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border h-full">
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="dark:text-white font-bold">Identitas Pengembang</h6>
                </div>
                <div class="flex-auto p-6">
                    <div class="flex flex-col items-center justify-center">

                        <div class="relative mb-4">
                            <img src="https://i.pravatar.cc/150?img=11" alt="Foto Pengembang"
                                class="w-32 h-32 rounded-full shadow-lg border-4 border-emerald-500 object-cover">
                        </div>

                        <h5 class="mb-1 text-xl font-bold text-slate-700 dark:text-white">Clearesta Rahimah Thee</h5>
                        <p class="mb-0 text-sm font-semibold text-slate-500 dark:text-white/60">NIM: 2457301029</p>
                        <p class="mb-4 text-sm text-slate-500 dark:text-white/60">D4 Sistem Informasi - Politeknik Caltex
                            Riau</p>

                        <div class="flex w-full justify-center gap-4 mt-4">
                            {{-- GitHub (Warna Slate/Hitam) --}}
                            <a href="https://github.com/cleaaresta" target="_blank" style="background-color: #1e293b;"
                                class="inline-flex items-center justify-center w-10 h-10 text-white rounded-full shadow-md transition-all duration-200 hover:shadow-lg hover:-translate-y-1">
                                <i class="fab fa-github text-lg"></i>
                            </a>

                            {{-- LinkedIn (Warna Biru) --}}
                            <a href="https://linkedin.com/in/clearesta-rahimah" target="_blank"
                                style="background-color: #0077b5;"
                                class="inline-flex items-center justify-center w-10 h-10 text-white rounded-full shadow-md transition-all duration-200 hover:shadow-lg hover:-translate-y-1">
                                <i class="fab fa-linkedin-in text-lg"></i>
                            </a>

                            {{-- Instagram (Warna Pink) --}}
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
        // Reset semua slide ke hidden
        slides.forEach((slide) => {
            slide.classList.remove('opacity-100', 'z-10');
            slide.classList.add('opacity-0', 'z-0');
        });

        // Tampilkan slide yang aktif
        slides[index].classList.remove('opacity-0', 'z-0');
        slides[index].classList.add('opacity-100', 'z-10');
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides; // Loop kembali ke awal jika sudah di akhir
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides; // Loop ke akhir jika di awal
        showSlide(currentSlide);
    }

    // Opsional: Auto-play setiap 5 detik
    setInterval(nextSlide, 5000);
</script>
@endsection

