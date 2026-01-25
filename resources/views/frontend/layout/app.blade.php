<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Smart Tourism System - STOURSYS'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
    
    <style>
        /* Enhanced animations and effects */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        .mobile-menu-enter {
            animation: slideDown 0.3s ease-out;
        }
        
        .logo-glow {
            filter: drop-shadow(0 0 8px rgba(255, 140, 0, 0.3));
            transition: filter 0.3s ease;
        }
        
        .logo-glow:hover {
            filter: drop-shadow(0 0 12px rgba(255, 140, 0, 0.5));
        }
        
        .nav-link-gradient {
            background: linear-gradient(90deg, #ea580c 0%, #f97316 100%);
            background-size: 0% 2px;
            background-repeat: no-repeat;
            background-position: left bottom;
            transition: background-size 0.3s ease;
        }
        
        .nav-link-gradient:hover {
            background-size: 100% 2px;
        }
        
        .header-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #ea580c 0%, #f97316 50%, #fb923c 100%);
            background-size: 200% 100%;
            background-position: left;
            transition: background-position 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }
        
        .btn-gradient:hover {
            background-position: right;
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -5px rgba(234, 88, 12, 0.4);
        }
        
        .btn-gradient:active {
            transform: translateY(0);
        }
        
        .footer-gradient {
            background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
        }
        
        .divider-gradient {
            background: linear-gradient(90deg, #3b82f6 0%, #60a5fa 25%, #f97316 75%, #fb923c 100%);
        }
        
        .home-btn {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            transition: all 0.3s ease;
        }
        
        .home-btn:hover {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            transform: translateY(-1px);
            box-shadow: 0 8px 16px -4px rgba(59, 130, 246, 0.4);
        }
        
        .home-btn-inactive {
            background: #f3f4f6;
            color: #374151;
            transition: all 0.3s ease;
        }
        
        .home-btn-inactive:hover {
            background: #e5e7eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px -2px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="font-figtree antialiased bg-gradient-to-br from-gray-50 via-white to-orange-50/30 text-gray-900">

    <!-- Header / Navbar (sticky + blur effect) -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-xl border-b border-gray-200/50 header-shadow transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">

                <!-- Logo kiri -->
                <a href="/" class="flex items-center gap-3 flex-shrink-0 group">
                    <img 
                        src="{{ asset('storage/images/candi.png') }}" 
                        alt="Logo Candi" 
                        class="h-10 md:h-12 w-auto object-contain logo-glow transform group-hover:scale-105 transition-transform duration-300"
                    >
                    <div class="hidden sm:block">
                        <div class="font-bold text-xl lg:text-2xl bg-gradient-to-r from-[#001f3f] to-[#003366] bg-clip-text text-transparent tracking-tight">STOURSYS</div>
                        <div class="text-xs text-gray-600 font-medium">Smart Tourism System</div>
                    </div>
                </a>

                <!-- Menu Desktop -->
                <nav class="hidden lg:flex items-center gap-6 xl:gap-8">
                    <a href="/" 
                       class="font-medium transition-all duration-300 px-4 py-2 rounded-lg shadow-md flex items-center gap-2 {{ request()->is('/') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Home
                    </a>
                    <a href="{{ route('destinasi.index') }}" 
                       class="font-medium transition-all duration-300 relative py-1 {{ request()->routeIs('destinasi.*') ? 'text-orange-600 font-semibold' : 'text-gray-700 hover:text-orange-600 nav-link-gradient' }}">
                        Destinasi
                        @if(request()->routeIs('destinasi.*'))
                            <span class="absolute left-0 bottom-[-4px] h-0.5 w-full bg-orange-600"></span>
                        @endif
                    </a>
                    <a href="{{ route('event.index') }}" 
                       class="font-medium transition-all duration-300 relative py-1 {{ request()->routeIs('event.*') ? 'text-orange-600 font-semibold' : 'text-gray-700 hover:text-orange-600 nav-link-gradient' }}">
                        Event
                        @if(request()->routeIs('event.*'))
                            <span class="absolute left-0 bottom-[-4px] h-0.5 w-full bg-orange-600"></span>
                        @endif
                    </a>
                    <a href="{{ route('berita.index') }}" 
                       class="font-medium transition-all duration-300 relative py-1 {{ request()->routeIs('berita.*') ? 'text-orange-600 font-semibold' : 'text-gray-700 hover:text-orange-600 nav-link-gradient' }}">
                        Berita
                        @if(request()->routeIs('berita.*'))
                            <span class="absolute left-0 bottom-[-4px] h-0.5 w-full bg-orange-600"></span>
                        @endif
                    </a>
                    <a href="{{ route('panduan.index') }}" 
                       class="font-medium transition-all duration-300 relative py-1 {{ request()->routeIs('panduan.*') ? 'text-orange-600 font-semibold' : 'text-gray-700 hover:text-orange-600 nav-link-gradient' }}">
                        Panduan
                        @if(request()->routeIs('panduan.*'))
                            <span class="absolute left-0 bottom-[-4px] h-0.5 w-full bg-orange-600"></span>
                        @endif
                    </a>
                    <a href="{{ route('kontak.index') }}" 
                       class="font-medium transition-all duration-300 relative py-1 {{ request()->routeIs('kontak.*') ? 'text-orange-600 font-semibold' : 'text-gray-700 hover:text-orange-600 nav-link-gradient' }}">
                        Kontak
                        @if(request()->routeIs('kontak.*'))
                            <span class="absolute left-0 bottom-[-4px] h-0.5 w-full bg-orange-600"></span>
                        @endif
                    </a>
                </nav>

                <!-- Mobile Hamburger -->
                <div class="flex items-center gap-4">
                    <button id="mobileMenuBtn" class="lg:hidden text-gray-700 hover:text-orange-600 focus:outline-none transition-colors duration-300 p-1">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobileMenu" class="hidden lg:hidden bg-white/95 backdrop-blur-lg border-t border-gray-200/70 shadow-xl">
            <div class="px-6 py-6 space-y-4">
                <a href="/" class="flex items-center gap-2 text-lg font-semibold px-4 py-3 rounded-lg shadow-md {{ request()->is('/') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Home
                </a>
                <a href="{{ route('destinasi.index') }}" class="block text-lg font-semibold py-2 {{ request()->routeIs('destinasi.*') ? 'text-orange-600 translate-x-2' : 'text-gray-700 hover:text-orange-600 hover:translate-x-2' }} transition-all duration-300">Destinasi</a>
                <a href="{{ route('event.index') }}" class="block text-lg font-semibold py-2 {{ request()->routeIs('event.*') ? 'text-orange-600 translate-x-2' : 'text-gray-700 hover:text-orange-600 hover:translate-x-2' }} transition-all duration-300">Event</a>
                <a href="{{ route('berita.index') }}" class="block text-lg font-semibold py-2 {{ request()->routeIs('berita.*') ? 'text-orange-600 translate-x-2' : 'text-gray-700 hover:text-orange-600 hover:translate-x-2' }} transition-all duration-300">Berita</a>
                <a href="{{ route('panduan.index') }}" class="block text-lg font-semibold py-2 {{ request()->routeIs('panduan.*') ? 'text-orange-600 translate-x-2' : 'text-gray-700 hover:text-orange-600 hover:translate-x-2' }} transition-all duration-300">Panduan</a>
                <a href="{{ route('kontak.index') }}" class="block text-lg font-semibold py-2 {{ request()->routeIs('kontak.*') ? 'text-orange-600 translate-x-2' : 'text-gray-700 hover:text-orange-600 hover:translate-x-2' }} transition-all duration-300">Kontak</a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="pt-16 md:pt-20 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-gradient text-white relative overflow-hidden">
        <!-- Decorative background pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-orange-400 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
        </div>
        
        <div class="h-1.5 divider-gradient w-full"></div>
        
        <div class="max-w-7xl mx-auto px-6 py-6 relative">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
                <div class="flex items-center gap-3 group">
                    <div class="bg-white/10 backdrop-blur-sm p-2 rounded-lg group-hover:bg-white/20 transition-all duration-300">
                        <img src="{{ asset('storage/images/logotutwuri.png') }}" alt="Logo Kemendikbud" class="h-8 w-8 object-contain">
                    </div>
                    <div>
                        <h4 class="font-bold text-base text-white/95">Direktorat Penelitian dan Pengabdian kepada Masyarakat</h4>
                        <p class="text-xs text-white/70 mt-0.5 font-medium">Sistem Informasi Pariwisata Cerdas</p>
                    </div>
                </div>

                <div class="text-xs text-white/60 font-medium">
                    © {{ date('Y') }} <span class="text-white/80 font-semibold">STOURSYS</span> • All rights reserved
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobileMenuBtn');
            const menu = document.getElementById('mobileMenu');

            btn.addEventListener('click', () => {
                const isHidden = menu.classList.contains('hidden');
                menu.classList.toggle('hidden');
                
                if (isHidden) {
                    menu.classList.add('mobile-menu-enter');
                    setTimeout(() => {
                        menu.classList.remove('mobile-menu-enter');
                    }, 300);
                }
            });

            // Tutup menu jika klik di luar
            document.addEventListener('click', (e) => {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>