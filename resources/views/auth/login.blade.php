<!DOCTYPE html>
<html>
<head>
    @include('admin1.partials.css')
    <title>Login - Posyandu</title>
</head>

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500 flex items-center justify-center min-h-screen">

    <main class="w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
        <section class="flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">

            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent text-center">
                <h4 class="font-bold">Sign In</h4>
                <p class="mb-0">Masukkan email dan password untuk login</p>
            </div>

            <div class="flex-auto p-6">

                <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf

                    @error('email')
                    <div id="error-alert"
                        {{--
                            Menggunakan kelas dari 'sidebar.blade.php'
                            'bg-red-500/30' = background merah 30%
                            'text-red-600' = teks merah
                        --}}
                        class="relative p-4 mt-4 mb-0 text-sm text-red-600 bg-red-500/30 rounded-lg"
                        role="alert">

                        {{-- Ini adalah "Login Gagal!" --}}
                        <span class="font-semibold">Login Gagal!</span>

                        {{-- Ini adalah "{{ $message }}" (isinya: Email atau Password... dst) --}}
                        {{ $message }}

                        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-red-600 pr-2"
                                onclick="document.getElementById('error-alert').style.display='none'">
                            <span class="text-2xl" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                    <div class="mb-4 mt-6">
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                            placeholder="Email"
                            aria-label="Email" />
                    </div>

                    <div class="mb-4">
                        <input
                            type="password"
                            name="password"
                            required
                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                            placeholder="Password"
                            aria-label="Password" />
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="inline-block w-full px-16 py-3.5 mt-6 mb-0 text-sm font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">
                            Sign in
                        </button>
                    </div>
                </form>

            </div>
        </section>
    </main>

    @include('admin1.partials.js')
</body>
</html>
