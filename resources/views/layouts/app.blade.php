<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('meta_description', 'Madstars | Calisthenics')">
        <meta name="keywords" content="@yield('meta_keywords', 'calisthenics, madstars')">
        <title>@yield('meta_title', 'Madstars | Calisthenics')</title>

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-R20Z8VZ953"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-R20Z8VZ953');
        </script>

        @stack('head')
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @include('layouts.navigation')

        <div class="min-h-screen">
            <div class="second-nav flex items-center justify-between bg-gray-900 border-b border-gray-800 px-4 py-3 top-0 z-50">
                <!-- Logo -->
                <div class="logo-container">
                    <a href="/"><img src="{{ asset('storage/pageLogo/logo.png') }}" alt="logo" class="h-10"></a>
                </div>

                <!-- Navigation Links -->
                @if(!Auth::user())
                    <div class="nav-links flex gap-6">
                        <!-- Login Button -->
                        <a href="/login"
                        class="text-white font-medium border border-white bg-black px-4 py-2 rounded-md transition-colors
                        hover:bg-white hover:text-black">
                            Login
                        </a>
                        <!-- Register Button -->
                        <a href="/register"
                        class="text-white font-medium bg-blue-600 px-4 py-2 rounded-md transition-colors
                        hover:bg-white hover:text-blue-600 border border-transparent">
                            Register
                        </a>
                    </div>
                @endif
            </div>
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content') <!-- This will display content from child views -->
            </main>
            <!-- Include the Footer -->
            @include('layouts.footer') <!-- This includes the footer.blade.php -->
        </div>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    </body>
</html>