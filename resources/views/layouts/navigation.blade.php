<header class="bg-[#001f3f] text-white shadow-md">
    <div class="w-full py-4 md:py-5 px-4 md:px-6">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-2 md:gap-4">
            
            <!-- Logo kiri -->
            <div class="flex-shrink-0">
                <img 
                    src="{{ asset('storage/images/candi.png') }}"
                    alt="Logo Candi" 
                    class="h-12 md:h-14 lg:h-16 xl:h-20 w-auto object-contain drop-shadow-lg"
                >
            </div>
            
            <!-- Judul di tengah -->
            <div class="flex-1 text-center">
                <div class="flex items-center justify-center gap-3 md:gap-4 lg:gap-5">
                    <h1 class="text-2xl md:text-4xl lg:text-5xl xl:text-6xl font-bold tracking-wide">
                        Smart Tourism System
                    </h1>
                    <p class="text-xl md:text-3xl lg:text-4xl xl:text-5xl font-semibold text-orange-400">
                        (STOURSYSYS)
                    </p>
                </div>
            </div>

            <!-- Bagian kanan: Logo Diktisaintek Berdampak + Tombol Login / User Info -->
            <div class="flex items-center gap-6 md:gap-10 lg:gap-16 xl:gap-20 flex-shrink-0">
                <!-- Logo Kemendikti - BULAT seperti di gambar -->
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 md:w-14 md:h-14 lg:w-16 lg:h-16 xl:w-20 xl:h-20 rounded-full overflow-hidden bg-white flex items-center justify-center p-1 md:p-2 shadow-lg">
                        <img 
                            src="{{ asset('storage/images/diktilogo.png') }}"
                            alt="Logo Diktisaintek Berdampak" 
                            class="w-full h-full object-contain"
                        >
                    </div>
                </div>

                <!-- Tombol Login atau User Info -->
                @auth
                    <div class="flex items-center gap-2 md:gap-3 lg:gap-4 flex-shrink-0">
                        <span class="text-orange-300 font-medium hidden lg:inline text-sm xl:text-base">
                            {{ Auth::user()->name }}
                        </span>
                        <a href="{{ route('dashboard') }}" 
                           class="text-white hover:text-orange-300 transition text-xs md:text-sm lg:text-base whitespace-nowrap">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-white hover:text-orange-300 transition text-xs md:text-sm lg:text-base whitespace-nowrap">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Icon Login - Tanpa Text -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('login') }}" 
                           class="flex items-center justify-center w-10 h-10 md:w-12 md:h-12 lg:w-14 lg:h-14 bg-orange-600 hover:bg-orange-700 rounded-full shadow-lg transition transform hover:scale-110 group"
                           title="Login Admin">
                            <svg class="w-5 h-5 md:w-6 md:h-6 lg:w-7 lg:h-7 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>