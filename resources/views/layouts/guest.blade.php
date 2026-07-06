<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-600 bg-cover bg-center bg-no-repeat"
             style="background-image: linear-gradient(rgba(15, 23, 42, 0.65), rgba(15, 23, 42, 0.65)), url('{{ asset('images/logo.png') }}');">
            
            <!-- HEADER ATAS -->
            <div class="mb-4 text-center">
                <h1 class="text-3xl font-bold text-white tracking-widest uppercase drop-shadow-md">
                    Sistem Pengaduan Daerah
                </h1>
            </div>

            <!-- KOTAK FORM: Diubah menjadi transparan (bg-white/85) dan berefek blur (backdrop-blur-md) -->
            <div class="w-full sm:max-w-md mt-16 px-6 py-6 bg-white/85 backdrop-blur-md shadow-2xl rounded-2xl relative border border-white/20">
                
                <!-- POSISI LOGO BULAT -->
                <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 z-10">
                    <a href="/">
                        <x-application-logo />
                    </a>
                </div>

                <!-- ISI FORM -->
                <div class="mt-12">
                    {{ $slot }}
                </div>
            </div>

            <!-- FOOTER BAWAH -->
            <div class="mt-8 text-center text-xs text-slate-300">
                sistempengaduandaerah.test - Kontak - Tentang - &copy; {{ date('Y') }} - v1.0.1
            </div>

        </div>
    </body>
</html>