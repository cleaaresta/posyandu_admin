<!DOCTYPE html>
<html>
<head>
    @include('layouts.admin.css')
    <title>Login - Posyandu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500 flex items-center justify-center min-h-screen p-4">

    <main class="w-full max-w-sm mx-auto"> <!-- Ganti max-w-3xl menjadi max-w-sm untuk ukuran kecil -->
        <section class="flex flex-col lg:flex-row min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border overflow-hidden">

            <!-- Kolom Kiri (Branding Panel) -->
            <div class="hidden lg:flex flex-col justify-center items-center w-full lg:w-5/12 p-12 text-center text-white bg-gradient-to-r from-blue-500 to-purple-600">
                <i class="fas fa-baby fa-5x mb-6"></i>
                <h1 class="font-bold text-3xl mb-2">Selamat Datang!</h1>
                <h4 class="font-semibold text-xl mb-1">Sistem Informasi Posyandu</h4>
                <p class="text-sm text-blue-100">Manajemen Data Kesehatan Ibu dan Anak</p>
            </div>

            <!-- Kolom Kanan (Form Panel) -->
            <div class="w-full lg:w-7/12 flex-auto p-6 md:p-12">

                <!-- Judul Form -->
                <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent text-center lg:text-left">
                    <h5 class="font-bold text-2xl">Sign In</h5>
                    <p class="mb-0 text-slate-600">Masukkan email dan password untuk login</p>
                </div>

                <div class="flex-auto p-6 pt-0">
                    <form role="form" method="POST" action="{{ route('login') }}">
                        @csrf

                        @error('email')
                        <div id="error-alert" class="relative p-4 mt-4 mb-0 text-sm text-red-600 bg-red-500/30 rounded-lg"
                            role="alert">
                            <span class="font-semibold">Login Gagal!</span>
                            {{ $message }}
                            <button type="button"
                                class="absolute top-0 bottom-0 right-0 px-4 py-3 text-red-600 pr-2"
                                onclick="document.getElementById('error-alert').style.display='none'">
                                <span class="text-2xl" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror

                        <!-- Input Email -->
                        <div class="mb-4 mt-6">
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                placeholder="Email" aria-label="Email" />
                        </div>

                        <!-- Input Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                            <input type="password" name="password" id="password" required
                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                placeholder="Password" aria-label="Password" />
                        </div>

                        <!-- Tombol Sign In yang Dimodifikasi dengan Tombol Sign Out -->
                        <div class="text-center">
                            <button type="submit"
                                class="inline-block w-full px-6 py-3.5 mt-6 mb-0 text-sm font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs ease-in tracking-tight-rem shadow-md">
                                <i class="fa fa-sign-out-alt sm:mr-1"></i> 
                                <span class="hidden sm:inline">Sign In</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div> <!-- Akhir Kolom Kanan -->

        </section>
    </main>

    @include('layouts.admin.js')

</body>
</html>
