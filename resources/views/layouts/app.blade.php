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

        <style>
            /* Hilangkan scroll dan overflow */
            html, body {
                margin: 0;
                padding: 0;
                height: 100%;
                overflow: hidden;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col" style="height: 100vh; overflow: hidden;">
            
            <!-- Header -->
            <header class="bg-[#001f3f] text-white shadow-md flex-shrink-0">
                <div class="w-full py-3 md:py-4 px-4 md:px-6">
                    <div class="max-w-7xl mx-auto">
                        <div class="flex items-center justify-between gap-4">
                            
                            <!-- Logo kiri -->
                            <div class="flex-shrink-0">
                                <img 
                                    src="{{ asset('storage/images/candi.png') }}"
                                    alt="Logo Candi" 
                                    class="h-14 md:h-16 lg:h-18 w-auto object-contain drop-shadow-lg"
                                >
                            </div>
                            
                            <!-- Judul di tengah -->
                            <div class="flex-1 text-center px-4">
                                <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-3">
                                    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold tracking-wide leading-tight">
                                        Smart Tourism System
                                    </h1>
                                    <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-semibold text-orange-400">
                                        (STOURSYS)
                                    </p>
                                </div>
                            </div>

                            <!-- Bagian kanan: Logo Diktisaintek + Tombol Login / User Info -->
                            <div class="flex items-center gap-3 md:gap-6 lg:gap-8 flex-shrink-0">
                                <!-- Logo Kemendikti - BULAT -->
                                <div class="flex-shrink-0">
                                    <div class="w-14 h-14 md:w-16 md:h-16 lg:w-18 lg:h-18 rounded-full overflow-hidden bg-white flex items-center justify-center p-1.5 shadow-lg">
                                        <img 
                                            src="{{ asset('storage/images/diktilogo.png') }}"
                                            alt="Logo Diktisaintek Berdampak" 
                                            class="w-full h-full object-contain"
                                        >
                                    </div>
                                </div>

                                <!-- Tombol Login atau User Info -->
                                @auth
                                    <div class="flex items-center gap-2 md:gap-3 flex-shrink-0">
                                        <span class="text-orange-300 font-medium hidden lg:inline text-sm">
                                            {{ Auth::user()->name }}
                                        </span>
                                        <a href="{{ route('dashboard') }}" 
                                           class="text-white hover:text-orange-300 transition text-xs md:text-sm whitespace-nowrap">
                                            Dashboard
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-white hover:text-orange-300 transition text-xs md:text-sm whitespace-nowrap">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <!-- Icon Login -->
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('login') }}" 
                                           class="flex items-center justify-center w-11 h-11 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-orange-600 hover:bg-orange-700 rounded-full shadow-lg transition transform hover:scale-110 group"
                                           title="Login Admin">
                                            <svg class="w-5 h-5 md:w-6 md:h-6 lg:w-7 lg:h-7 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Navigation Menu -->
            <nav class="bg-white shadow-lg flex-shrink-0">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-center py-2">
                        <!-- Menu Items - Centered -->
                        <div class="flex items-center justify-center gap-4 sm:gap-6 md:gap-8 lg:gap-12 xl:gap-16">
                            
                            <a href="{{ route('destinasi.index') }}" class="group relative flex flex-col items-center gap-1 px-2 md:px-3 py-2 text-blue-700 hover:text-orange-500 transition-all duration-300 transform hover:scale-105">
                                <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 lg:w-18 lg:h-18 rounded-full bg-blue-100 group-hover:bg-orange-500 backdrop-blur-sm transition-all duration-300 shadow-lg">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 text-blue-700 group-hover:text-white group-hover:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <span class="text-xs sm:text-sm md:text-base lg:text-lg font-semibold tracking-wide mt-1">Destinasi</span>
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></div>
                            </a>

                            <a href="{{ route('event.index') }}" class="group relative flex flex-col items-center gap-1 px-2 md:px-3 py-2 text-blue-700 hover:text-orange-500 transition-all duration-300 transform hover:scale-105">
                                <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 lg:w-18 lg:h-18 rounded-full bg-blue-100 group-hover:bg-orange-500 backdrop-blur-sm transition-all duration-300 shadow-lg">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 text-blue-700 group-hover:text-white group-hover:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="text-xs sm:text-sm md:text-base lg:text-lg font-semibold tracking-wide mt-1">Event</span>
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></div>
                            </a>

                            <a href="{{ route('kontak.index') }}" class="group relative flex flex-col items-center gap-1 px-2 md:px-3 py-2 text-blue-700 hover:text-orange-500 transition-all duration-300 transform hover:scale-105">
                                <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 lg:w-18 lg:h-18 rounded-full bg-blue-100 group-hover:bg-orange-500 backdrop-blur-sm transition-all duration-300 shadow-lg">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 text-blue-700 group-hover:text-white group-hover:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="text-xs sm:text-sm md:text-base lg:text-lg font-semibold tracking-wide mt-1">Kontak</span>
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></div>
                            </a>

                            <a href="{{ route('panduan.index') }}" class="group relative flex flex-col items-center gap-1 px-2 md:px-3 py-2 text-blue-700 hover:text-orange-500 transition-all duration-300 transform hover:scale-105">
                                <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 lg:w-18 lg:h-18 rounded-full bg-blue-100 group-hover:bg-orange-500 backdrop-blur-sm transition-all duration-300 shadow-lg">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 text-blue-700 group-hover:text-white group-hover:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <span class="text-xs sm:text-sm md:text-base lg:text-lg font-semibold tracking-wide mt-1">Panduan</span>
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></div>
                            </a>

                            <a href="{{ route('berita.index') }}" class="group relative flex flex-col items-center gap-1 px-2 md:px-3 py-2 text-blue-700 hover:text-orange-500 transition-all duration-300 transform hover:scale-105">
                                <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 lg:w-18 lg:h-18 rounded-full bg-blue-100 group-hover:bg-orange-500 backdrop-blur-sm transition-all duration-300 shadow-lg">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 text-blue-700 group-hover:text-white group-hover:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                                <span class="text-xs sm:text-sm md:text-base lg:text-lg font-semibold tracking-wide mt-1">Berita</span>
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading (Optional) -->
            @isset($header)
                <div class="bg-white shadow flex-shrink-0">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow overflow-hidden">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-[#001f3f] text-white flex-shrink-0">
                <div class="h-1.5 bg-blue-500 w-full"></div>
                <div class="py-4 md:py-6 px-4 md:px-6">
                    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 md:gap-6">
                        <div class="flex items-center gap-3 md:gap-4">
                            <img 
                                src="{{ asset('storage/images/logotutwuri.png') }}" 
                                alt="Logo Kemendikbud" 
                                class="h-10 w-10 md:h-12 md:w-12 object-contain flex-shrink-0"
                            />
                            <div>
                                <h3 class="text-sm md:text-lg lg:text-xl font-bold tracking-wide">
                                    Direktorat Penelitian dan Pengabdian kepada Masyarakat
                                </h3>
                                <p class="text-xs md:text-sm text-gray-300 mt-1">
                                    2026 · Sistem Informasi Pariwisata
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        @stack('scripts')
    </body>
</html>