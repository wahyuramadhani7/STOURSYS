@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Banner - Redesigned dengan gradasi lebih soft -->
    <div class="relative overflow-hidden bg-gradient-to-r from-orange-50 via-orange-100 to-amber-50 rounded-3xl p-8 border border-orange-200/50 shadow-xl">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-orange-300/20 to-amber-300/20 rounded-full blur-3xl -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-orange-200/30 to-yellow-200/30 rounded-full blur-3xl -ml-32 -mb-32"></div>
        
        <!-- Pattern overlay -->
        <div class="absolute inset-0 opacity-5">
            <svg width="100%" height="100%">
                <pattern id="pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="1" fill="currentColor" class="text-orange-600"/>
                </pattern>
                <rect width="100%" height="100%" fill="url(#pattern)"/>
            </svg>
        </div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div class="space-y-3">
                    <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full border border-orange-200 shadow-sm">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-xs font-semibold text-gray-700">Admin Online</span>
                    </div>
                    <h2 class="text-4xl font-bold bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent">
                        Selamat Datang, {{ Auth::user()->name }}! 👋
                    </h2>
                    <p class="text-gray-600 text-lg font-medium">Kelola sistem Smart Tourism Kawasan Wisata Borobudur</p>
                    <p class="text-gray-500 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ now()->isoFormat('dddd, D MMMM Y') }}
                    </p>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="bg-white/90 backdrop-blur-md px-6 py-4 rounded-2xl border border-orange-200/50 shadow-lg hover:shadow-xl transition-all">
                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Waktu Server</div>
                        <div class="text-3xl font-bold bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent tabular-nums" id="clock">
                            {{ now()->format('H:i:s') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards - Redesigned dengan spacing lebih baik -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
        <!-- Card Destinasi -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-orange-300">
            <!-- Gradient background -->
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-orange-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="p-6 relative">
                <!-- Icon dan Badge -->
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-orange-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-orange-500 to-orange-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-orange-600 bg-orange-100 px-3 py-1.5 rounded-full">Aktif</span>
                </div>
                
                <!-- Content -->
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Destinasi</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-orange-600 transition-colors tabular-nums">
                        {{ \App\Models\Destinasi::count() }}
                    </p>
                    <div class="flex items-center gap-2 text-sm pt-2">
                        <div class="flex items-center gap-1 text-green-600 bg-green-50 px-2 py-1 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">100%</span>
                        </div>
                        <span class="text-gray-600">Destinasi terdaftar</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Event -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-blue-300">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-100 px-3 py-1.5 rounded-full">Upcoming</span>
                </div>
                
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Event Mendatang</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-blue-600 transition-colors tabular-nums">
                        {{ \App\Models\Event::where('tanggal_mulai', '>=', now())->count() }}
                    </p>
                    <div class="flex items-center gap-2 text-sm pt-2">
                        <div class="flex items-center gap-1 text-blue-600 bg-blue-50 px-2 py-1 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">Soon</span>
                        </div>
                        <span class="text-gray-600">Acara akan datang</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Berita -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-purple-300">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-purple-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-purple-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-purple-500 to-purple-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-purple-600 bg-purple-100 px-3 py-1.5 rounded-full">Published</span>
                </div>
                
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Berita</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-purple-600 transition-colors tabular-nums">
                        {{ \App\Models\Berita::count() }}
                    </p>
                    <div class="flex items-center gap-2 text-sm pt-2">
                        <div class="flex items-center gap-1 text-purple-600 bg-purple-50 px-2 py-1 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">Live</span>
                        </div>
                        <span class="text-gray-600">Artikel & informasi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Pesan -->
        <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-red-300">
            <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-red-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <!-- Badge notifikasi -->
            <div class="absolute -top-1 -right-1 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-lg animate-bounce z-10">
                !
            </div>
            
            <div class="p-6 relative">
                <div class="flex items-start justify-between mb-5">
                    <div class="relative">
                        <div class="absolute inset-0 bg-red-500 blur-xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                        <div class="relative bg-gradient-to-br from-red-500 to-red-600 p-3.5 rounded-2xl shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-red-600 bg-red-100 px-3 py-1.5 rounded-full animate-pulse">Baru</span>
                </div>
                
                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Pesan Masuk</h3>
                    <p class="text-5xl font-black text-gray-800 group-hover:text-red-600 transition-colors tabular-nums">
                        {{ \App\Models\PesanKontak::where('status', 'baru')->count() }}
                    </p>
                    <div class="flex items-center gap-2 text-sm pt-2">
                        <div class="flex items-center gap-1 text-red-600 bg-red-50 px-2 py-1 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <span class="font-semibold">Urgent</span>
                        </div>
                        <span class="text-gray-600">Belum dibaca</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- System Info - Lebih lebar -->
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-all">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-3 rounded-2xl shadow-md">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span>Informasi Sistem</span>
                </h3>
                <div class="text-xs text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full font-medium">
                    Real-time
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Item 1 -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-orange-50 to-orange-100/50 rounded-2xl p-5 border-2 border-orange-200/50 hover:border-orange-400 transition-all hover:shadow-md">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-orange-300 rounded-full -mr-12 -mt-12 opacity-10 group-hover:opacity-20 transition-opacity"></div>
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="bg-orange-500 p-2 rounded-xl">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700">Total Destinasi Aktif</span>
                        </div>
                        <div class="text-4xl font-black text-orange-600 tabular-nums">{{ \App\Models\Destinasi::count() }}</div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-2xl p-5 border-2 border-blue-200/50 hover:border-blue-400 transition-all hover:shadow-md">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-300 rounded-full -mr-12 -mt-12 opacity-10 group-hover:opacity-20 transition-opacity"></div>
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="bg-blue-500 p-2 rounded-xl">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700">Event Berlangsung</span>
                        </div>
                        <div class="text-4xl font-black text-blue-600 tabular-nums">{{ \App\Models\Event::where('tanggal_mulai', '<=', now())->where('tanggal_selesai', '>=', now())->count() }}</div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-2xl p-5 border-2 border-purple-200/50 hover:border-purple-400 transition-all hover:shadow-md">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-purple-300 rounded-full -mr-12 -mt-12 opacity-10 group-hover:opacity-20 transition-opacity"></div>
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="bg-purple-500 p-2 rounded-xl">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700">Berita Terpublikasi</span>
                        </div>
                        <div class="text-4xl font-black text-purple-600 tabular-nums">{{ \App\Models\Berita::count() }}</div>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-red-50 to-red-100/50 rounded-2xl p-5 border-2 border-red-200/50 hover:border-red-400 transition-all hover:shadow-md">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-red-300 rounded-full -mr-12 -mt-12 opacity-10 group-hover:opacity-20 transition-opacity"></div>
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="bg-red-500 p-2 rounded-xl relative">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-400 rounded-full animate-ping"></div>
                            </div>
                            <span class="text-sm font-semibold text-gray-700">Pesan Perlu Dibalas</span>
                        </div>
                        <div class="text-4xl font-black text-red-600 tabular-nums">{{ \App\Models\PesanKontak::where('status', 'baru')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links - Lebih compact -->
        <div class="bg-white rounded-3xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-all">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-3 rounded-2xl shadow-md">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                        </svg>
                    </div>
                    <span>Pintasan</span>
                </h3>
            </div>

            <div class="space-y-3">
                <a href="{{ route('admin.destinasi.index') }}" class="group flex items-center justify-between p-4 bg-gradient-to-r from-orange-50 to-orange-100/50 hover:from-orange-100 hover:to-orange-200/50 rounded-2xl transition-all border-2 border-orange-200/50 hover:border-orange-400 hover:shadow-md">
                    <div class="flex items-center gap-4">
                        <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-2.5 rounded-xl group-hover:scale-110 transition-transform shadow-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-orange-600 transition-colors">Kelola Destinasi</span>
                    </div>
                    <svg class="w-5 h-5 text-orange-500 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ route('admin.event.index') }}" class="group flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100/50 hover:from-blue-100 hover:to-blue-200/50 rounded-2xl transition-all border-2 border-blue-200/50 hover:border-blue-400 hover:shadow-md">
                    <div class="flex items-center gap-4">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2.5 rounded-xl group-hover:scale-110 transition-transform shadow-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-blue-600 transition-colors">Kelola Event</span>
                    </div>
                    <svg class="w-5 h-5 text-blue-500 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ route('admin.berita.index') }}" class="group flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-purple-100/50 hover:from-purple-100 hover:to-purple-200/50 rounded-2xl transition-all border-2 border-purple-200/50 hover:border-purple-400 hover:shadow-md">
                    <div class="flex items-center gap-4">
                        <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-2.5 rounded-xl group-hover:scale-110 transition-transform shadow-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-purple-600 transition-colors">Kelola Berita</span>
                    </div>
                    <svg class="w-5 h-5 text-purple-500 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ route('admin.kontak.index') }}" class="group flex items-center justify-between p-4 bg-gradient-to-r from-red-50 to-red-100/50 hover:from-red-100 hover:to-red-200/50 rounded-2xl transition-all border-2 border-red-200/50 hover:border-red-400 hover:shadow-md relative">
                    <!-- Notification badge -->
                    @if(\App\Models\PesanKontak::where('status', 'baru')->count() > 0)
                    <div class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center shadow-lg animate-bounce">
                        {{ \App\Models\PesanKontak::where('status', 'baru')->count() }}
                    </div>
                    @endif
                    
                    <div class="flex items-center gap-4">
                        <div class="bg-gradient-to-br from-red-500 to-red-600 p-2.5 rounded-xl group-hover:scale-110 transition-transform shadow-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-bold text-gray-700 group-hover:text-red-600 transition-colors">Kelola Pesan</span>
                    </div>
                    <svg class="w-5 h-5 text-red-500 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Real-time clock dengan animasi smooth
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const clockElement = document.getElementById('clock');
        
        if (clockElement) {
            const newTime = `${hours}:${minutes}:${seconds}`;
            if (clockElement.textContent !== newTime) {
                clockElement.style.opacity = '0.5';
                setTimeout(() => {
                    clockElement.textContent = newTime;
                    clockElement.style.opacity = '1';
                }, 150);
            }
        }
    }
    
    // Update setiap detik
    setInterval(updateClock, 1000);
    updateClock();

    // Smooth scroll untuk quick links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush
@endsection