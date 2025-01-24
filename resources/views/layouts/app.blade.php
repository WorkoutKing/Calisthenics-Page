<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('meta_description', 'Madstars | Calisthenics')">
        <meta name="keywords" content="@yield('meta_keywords', 'calisthenics, madstars')">
        <title>@yield('meta_title', 'Madstars | Calisthenics')</title>
        @stack('head')
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background: #000;">
        @include('layouts.navigation')

        <div class="min-h-screen" style="width: calc(100% - 80px); margin-left: 80px;">
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
        </div>

        <!-- Include the Footer -->
        @include('layouts.footer') <!-- This includes the footer.blade.php -->
    </body>
</html>
<style>
main {
    background: #000;
}
</style>