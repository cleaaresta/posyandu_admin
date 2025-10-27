<!DOCTYPE html>
<html>

<head>
    @include('admin1.partials/admin.css')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .whatsapp-fab {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25D366;
            color: #FFF;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            line-height: 60px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .whatsapp-fab:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }
    </style>

</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

    @include('admin1.partials/admin.sidebar')

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">

        @include('admin1.partials/admin.navbar')

        <div class="w-full px-6 py-6 mx-auto">
            @yield('content')

            @include('admin1.partials/admin.footer')
        </div>
    </main>


    @include('admin1.partials/admin.js')

    <a href="https://api.whatsapp.com/send?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20Anda."
        class="whatsapp-fab" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>


    @stack('scripts')

</body>

</html>
