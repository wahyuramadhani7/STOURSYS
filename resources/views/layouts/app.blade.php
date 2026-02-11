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
            /* Reset minimal untuk responsivitas */
            html, body {
                margin: 0;
                padding: 0;
                height: 100%;
                overflow-x: hidden;
            }
            
            /* Menghilangkan jeda putih di bawah footer */
            body {
                display: flex;
                flex-direction: column;
            }
            
            .min-h-screen {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            
            main {
                flex: 1;
                margin: 0;
                padding: 0;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            
            <!-- Header -->
            <header class="bg-[#001f3f] text-white shadow-md">
                <div class="w-full py-2 sm:py-2.5 md:py-3 px-3 sm:px-4 md:px-6">
                    <div class="max-w-7xl mx-auto">
                        <div class="flex items-center justify-between gap-2 sm:gap-3 md:gap-4">
                            
                            <!-- Logo kiri -->
                            <div class="flex-shrink-0">
                                <img 
                                    src="{{ asset('storage/images/candi.png') }}"
                                    alt="Logo Candi" 
                                    class="h-10 sm:h-12 md:h-14 lg:h-16 w-auto object-contain drop-shadow-lg"
                                >
                            </div>
                            
                            <!-- Judul di tengah -->
                            <div class="flex-1 text-center px-2 sm:px-3 min-w-0">
                                <div class="flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-1.5 md:gap-2.5">
                                    <h1 class="text-base sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl font-bold tracking-wide leading-tight">
                                        Smart Tourism System
                                    </h1>
                                    <p class="text-sm sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-semibold text-orange-400">
                                        (STOURSYS)
                                    </p>
                                </div>
                            </div>

                            <!-- Logo kanan -->
                            <div class="flex items-center gap-2 sm:gap-3 md:gap-4 lg:gap-5 flex-shrink-0">
                                <!-- Logo Kemendikti - BULAT -->
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 lg:w-16 lg:h-16 rounded-full overflow-hidden bg-white flex items-center justify-center p-1 sm:p-1.5 shadow-lg">
                                        <img 
                                            src="{{ asset('storage/images/diktilogo.png') }}"
                                            alt="Logo Diktisaintek Berdampak" 
                                            class="w-full h-full object-contain"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Navigation Menu -->
            <nav class="bg-white shadow-lg">
                <div class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
                    <div class="flex items-center justify-between py-2">
                        
                        <!-- Hamburger Button (Mobile & Tablet) -->
                        <button 
                            id="mobileMenuButton" 
                            class="lg:hidden flex items-center justify-center w-10 h-10 rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            aria-label="Toggle Menu"
                        >
                            <svg id="hamburgerIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        <!-- Menu Items - Desktop -->
                        <div class="hidden lg:flex items-center justify-center gap-1 lg:gap-2 xl:gap-3 w-full">
                            
                            <!-- Menu Stoursys -->
                            <a href="{{ route('stoursys.index') }}" class="group relative flex items-center gap-1 lg:gap-1.5 px-1.5 lg:px-2 py-1.5 text-blue-700 hover:text-orange-500 transition-all duration-300 transform hover:scale-105 rounded-lg hover:bg-orange-50">
                                <div class="flex items-center justify-center w-8 h-8 lg:w-9 lg:h-9 rounded-full bg-blue-100 group-hover:bg-orange-500 backdrop-blur-sm transition-all duration-300 shadow-lg flex-shrink-0">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-5 text-blue-700 group-hover:text-white group-hover:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-xs lg:text-sm xl:text-base font-semibold tracking-wide whitespace-nowrap">Stoursys</span>
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></div>
                            </a>

                            <!-- Menu Destinasi -->
                            <a href="{{ route('destinasi.index') }}" class="group relative flex items-center gap-1 lg:gap-1.5 px-1.5 lg:px-2 py-1.5 text-blue-700 hover:text-orange-500 transition-all duration-300 transform hover:scale-105 rounded-lg hover:bg-orange-50">
                                <div class="flex items-center justify-center w-8 h-8 lg:w-9 lg:h-9 rounded-full bg-blue-100 group-hover:bg-orange-500 backdrop-blur-sm transition-all duration-300 shadow-lg flex-shrink-0">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-5 text-blue-700 group-hover:text-white group-hover:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <span class="text-xs lg:text-sm xl:text-base font-semibold tracking-wide whitespace-nowrap">Destinasi</span>
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></div>
                            </a>

                            <!-- Menu Event -->
                            <a href="{{ route('event.index') }}" class="group relative flex items-center gap-1 lg:gap-1.5 px-1.5 lg:px-2 py-1.5 text-blue-700 hover:text-orange-500 transition-all duration-300 transform hover:scale-105 rounded-lg hover:bg-orange-50">
                                <div class="flex items-center justify-center w-8 h-8 lg:w-9 lg:h-9 rounded-full bg-blue-100 group-hover:bg-orange-500 backdrop-blur-sm transition-all duration-300 shadow-lg flex-shrink-0">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-5 text-blue-700 group-hover:text-white group-hover:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="text-xs lg:text-sm xl:text-base font-semibold tracking-wide whitespace-nowrap">Event</span>
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></div>
                            </a>

                            <!-- Menu Kontak -->
                            <a href="{{ route('kontak.index') }}" class="group relative flex items-center gap-1 lg:gap-1.5 px-1.5 lg:px-2 py-1.5 text-blue-700 hover:text-orange-500 transition-all duration-300 transform hover:scale-105 rounded-lg hover:bg-orange-50">
                                <div class="flex items-center justify-center w-8 h-8 lg:w-9 lg:h-9 rounded-full bg-blue-100 group-hover:bg-orange-500 backdrop-blur-sm transition-all duration-300 shadow-lg flex-shrink-0">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-5 text-blue-700 group-hover:text-white group-hover:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="text-xs lg:text-sm xl:text-base font-semibold tracking-wide whitespace-nowrap">Kontak</span>
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></div>
                            </a>

                            <!-- Menu Panduan -->
                            <a href="{{ route('panduan.index') }}" class="group relative flex items-center gap-1 lg:gap-1.5 px-1.5 lg:px-2 py-1.5 text-blue-700 hover:text-orange-500 transition-all duration-300 transform hover:scale-105 rounded-lg hover:bg-orange-50">
                                <div class="flex items-center justify-center w-8 h-8 lg:w-9 lg:h-9 rounded-full bg-blue-100 group-hover:bg-orange-500 backdrop-blur-sm transition-all duration-300 shadow-lg flex-shrink-0">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-5 text-blue-700 group-hover:text-white group-hover:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <span class="text-xs lg:text-sm xl:text-base font-semibold tracking-wide whitespace-nowrap">Panduan</span>
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></div>
                            </a>

                            <!-- Menu Berita -->
                            <a href="{{ route('berita.index') }}" class="group relative flex items-center gap-1 lg:gap-1.5 px-1.5 lg:px-2 py-1.5 text-blue-700 hover:text-orange-500 transition-all duration-300 transform hover:scale-105 rounded-lg hover:bg-orange-50">
                                <div class="flex items-center justify-center w-8 h-8 lg:w-9 lg:h-9 rounded-full bg-blue-100 group-hover:bg-orange-500 backdrop-blur-sm transition-all duration-300 shadow-lg flex-shrink-0">
                                    <svg class="w-4 h-4 lg:w-5 lg:h-5 text-blue-700 group-hover:text-white group-hover:rotate-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                                <span class="text-xs lg:text-sm xl:text-base font-semibold tracking-wide whitespace-nowrap">Berita</span>
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-orange-500 group-hover:w-full transition-all duration-300"></div>
                            </a>
                        </div>
                    </div>

                    <!-- Mobile Menu (Dropdown) -->
                    <div id="mobileMenu" class="lg:hidden hidden overflow-hidden transition-all duration-300">
                        <div class="py-2 space-y-1">
                            <!-- Mobile Menu Items -->
                            <a href="{{ route('stoursys.index') }}" class="flex items-center gap-3 px-4 py-3 text-blue-700 hover:text-orange-500 hover:bg-orange-50 transition-all duration-200 rounded-lg">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-base font-semibold">Stoursys</span>
                            </a>

                            <a href="{{ route('destinasi.index') }}" class="flex items-center gap-3 px-4 py-3 text-blue-700 hover:text-orange-500 hover:bg-orange-50 transition-all duration-200 rounded-lg">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <span class="text-base font-semibold">Destinasi</span>
                            </a>

                            <a href="{{ route('event.index') }}" class="flex items-center gap-3 px-4 py-3 text-blue-700 hover:text-orange-500 hover:bg-orange-50 transition-all duration-200 rounded-lg">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="text-base font-semibold">Event</span>
                            </a>

                            <a href="{{ route('kontak.index') }}" class="flex items-center gap-3 px-4 py-3 text-blue-700 hover:text-orange-500 hover:bg-orange-50 transition-all duration-200 rounded-lg">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span class="text-base font-semibold">Kontak</span>
                            </a>

                            <a href="{{ route('panduan.index') }}" class="flex items-center gap-3 px-4 py-3 text-blue-700 hover:text-orange-500 hover:bg-orange-50 transition-all duration-200 rounded-lg">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <span class="text-base font-semibold">Panduan</span>
                            </a>

                            <a href="{{ route('berita.index') }}" class="flex items-center gap-3 px-4 py-3 text-blue-700 hover:text-orange-500 hover:bg-orange-50 transition-all duration-200 rounded-lg">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                                <span class="text-base font-semibold">Berita</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading (Optional) -->
            @isset($header)
                <div class="bg-white shadow flex-shrink-0">
                    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-3 sm:px-4 md:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-[#001f3f] text-white">
                <div class="h-1 sm:h-1.5 bg-blue-500 w-full"></div>
                <div class="py-3 md:py-4 px-3 sm:px-4 md:px-6">
                    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-3 md:gap-4">
                        <div class="flex items-center gap-2 md:gap-3">
                            <img 
                                src="{{ asset('storage/images/logotutwuri.png') }}" 
                                alt="Logo Kemendikbud" 
                                class="h-8 w-8 sm:h-9 sm:w-9 md:h-10 md:w-10 object-contain flex-shrink-0"
                            />
                            <div class="text-center md:text-left">
                                <h3 class="text-xs sm:text-sm md:text-base lg:text-lg font-bold tracking-wide">
                                    Direktorat Penelitian dan Pengabdian kepada Masyarakat
                                </h3>
                                <p class="text-xs text-gray-300 mt-0.5">
                                    2026 · Sistem Informasi Pariwisata
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- JavaScript for Mobile Menu Toggle -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const mobileMenuButton = document.getElementById('mobileMenuButton');
                const mobileMenu = document.getElementById('mobileMenu');
                const hamburgerIcon = document.getElementById('hamburgerIcon');
                const closeIcon = document.getElementById('closeIcon');

                if (mobileMenuButton && mobileMenu) {
                    mobileMenuButton.addEventListener('click', function() {
                        mobileMenu.classList.toggle('hidden');
                        hamburgerIcon.classList.toggle('hidden');
                        closeIcon.classList.toggle('hidden');
                    });

                    // Close menu when clicking outside
                    document.addEventListener('click', function(event) {
                        const isClickInside = mobileMenuButton.contains(event.target) || mobileMenu.contains(event.target);
                        
                        if (!isClickInside && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                            hamburgerIcon.classList.remove('hidden');
                            closeIcon.classList.add('hidden');
                        }
                    });

                    // Close menu when window is resized to desktop
                    window.addEventListener('resize', function() {
                        if (window.innerWidth >= 1024 && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                            hamburgerIcon.classList.remove('hidden');
                            closeIcon.classList.add('hidden');
                        }
                    });
                }
            });
        </script>

        @stack('scripts')
    </body>
</html>