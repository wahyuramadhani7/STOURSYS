@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden bg-gradient-to-br from-orange-500 via-orange-600 to-orange-700 rounded-2xl p-8 text-white shadow-2xl">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-64 h-64 bg-white rounded-full opacity-10 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-48 h-48 bg-orange-400 rounded-full opacity-20 blur-3xl"></div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h2 class="text-3xl font-bold mb-2 text-black">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-black text-lg">Kelola sistem Smart Tourism Kawasan Wisata Borobudur</p>
                    <p class="text-black text-sm mt-1">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 backdrop-blur-sm px-5 py-3 rounded-xl border border-white/30">
                        <div class="text-sm text-black">Jam Server</div>
                        <div class="text-xl font-bold text-black" id="clock">{{ now()->format('H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card Destinasi -->
        <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border-2 border-transparent hover:border-orange-200">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full -mr-16 -mt-16 opacity-10 group-hover:opacity-20 transition-opacity"></div>
            <div class="p-6 relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-3 rounded-xl shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-3 py-1 rounded-full">Aktif</span>
                </div>
                <h3 class="text-black font-semibold text-sm mb-2">Total Destinasi</h3>
                <p class="text-4xl font-bold text-black mb-2">
                    {{ \App\Models\Destinasi::count() }}
                </p>
                <div class="flex items-center text-sm text-black">
                    <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                    </svg>
                    Destinasi wisata terdaftar
                </div>
            </div>
        </div>

        <!-- Card Event -->
        <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border-2 border-transparent hover:border-orange-200">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-300 to-orange-500 rounded-full -mr-16 -mt-16 opacity-10 group-hover:opacity-20 transition-opacity"></div>
            <div class="p-6 relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-orange-400 to-orange-500 p-3 rounded-xl shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-3 py-1 rounded-full">Upcoming</span>
                </div>
                <h3 class="text-black font-semibold text-sm mb-2">Event Mendatang</h3>
                <p class="text-4xl font-bold text-black mb-2">
                    {{ \App\Models\Event::where('tanggal_mulai', '>=', now())->count() }}
                </p>
                <div class="flex items-center text-sm text-black">
                    <svg class="w-4 h-4 mr-1 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                    Acara yang akan datang
                </div>
            </div>
        </div>

        <!-- Card Berita -->
        <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border-2 border-transparent hover:border-orange-200">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-300 to-orange-500 rounded-full -mr-16 -mt-16 opacity-10 group-hover:opacity-20 transition-opacity"></div>
            <div class="p-6 relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-3 rounded-xl shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-3 py-1 rounded-full">Published</span>
                </div>
                <h3 class="text-black font-semibold text-sm mb-2">Total Berita</h3>
                <p class="text-4xl font-bold text-black mb-2">
                    {{ \App\Models\Berita::count() }}
                </p>
                <div class="flex items-center text-sm text-black">
                    <svg class="w-4 h-4 mr-1 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                    </svg>
                    Artikel & informasi
                </div>
            </div>
        </div>

        <!-- Card Pesan -->
        <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border-2 border-transparent hover:border-red-200">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-red-400 to-red-600 rounded-full -mr-16 -mt-16 opacity-10 group-hover:opacity-20 transition-opacity"></div>
            <div class="p-6 relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-gradient-to-br from-red-500 to-red-600 p-3 rounded-xl shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-red-600 bg-red-50 px-3 py-1 rounded-full animate-pulse">Baru</span>
                </div>
                <h3 class="text-black font-semibold text-sm mb-2">Pesan Masuk</h3>
                <p class="text-4xl font-bold text-black mb-2">
                    {{ \App\Models\PesanKontak::where('status', 'baru')->count() }}
                </p>
                <div class="flex items-center text-sm text-black">
                    <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                    Belum dibaca
                </div>
            </div>
        </div>
    </div>

   
    <!-- Recent Activity / Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- System Info -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-gray-100 hover:border-orange-200 transition-colors">
            <h3 class="text-lg font-bold text-black mb-6 flex items-center">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                Informasi Sistem
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center p-4 bg-orange-50 rounded-xl border-l-4 border-orange-500 hover:bg-orange-100 transition-colors">
                    <span class="text-sm text-black font-medium">Total Destinasi Aktif</span>
                    <span class="text-lg font-bold text-black">{{ \App\Models\Destinasi::count() }}</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-orange-50 rounded-xl border-l-4 border-orange-400 hover:bg-orange-100 transition-colors">
                    <span class="text-sm text-black font-medium">Event Berlangsung</span>
                    <span class="text-lg font-bold text-black">{{ \App\Models\Event::where('tanggal_mulai', '<=', now())->where('tanggal_selesai', '>=', now())->count() }}</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-orange-50 rounded-xl border-l-4 border-orange-500 hover:bg-orange-100 transition-colors">
                    <span class="text-sm text-black font-medium">Berita Terpublikasi</span>
                    <span class="text-lg font-bold text-black">{{ \App\Models\Berita::count() }}</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-red-50 rounded-xl border-l-4 border-red-500 hover:bg-red-100 transition-colors">
                    <span class="text-sm text-black font-medium">Pesan Perlu Dibalas</span>
                    <span class="text-lg font-bold text-black">{{ \App\Models\PesanKontak::where('status', 'baru')->count() }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-gray-100 hover:border-orange-200 transition-colors">
            <h3 class="text-lg font-bold text-black mb-6 flex items-center">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                    </svg>
                </div>
                Pintasan Menu
            </h3>
            <div class="space-y-3">
                <a href="{{ route('admin.destinasi.index') }}" class="flex items-center justify-between p-4 bg-orange-50 hover:bg-orange-100 rounded-xl transition-all group border-l-4 border-orange-500 hover:border-orange-600">
                    <div class="flex items-center gap-3">
                        <div class="bg-orange-500 p-2 rounded-lg group-hover:scale-110 transition-transform">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-black group-hover:text-black">Kelola Destinasi</span>
                    </div>
                    <svg class="w-5 h-5 text-orange-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ route('admin.event.index') }}" class="flex items-center justify-between p-4 bg-orange-50 hover:bg-orange-100 rounded-xl transition-all group border-l-4 border-orange-400 hover:border-orange-500">
                    <div class="flex items-center gap-3">
                        <div class="bg-orange-400 p-2 rounded-lg group-hover:scale-110 transition-transform">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-black group-hover:text-black">Kelola Event</span>
                    </div>
                    <svg class="w-5 h-5 text-orange-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ route('admin.berita.index') }}" class="flex items-center justify-between p-4 bg-orange-50 hover:bg-orange-100 rounded-xl transition-all group border-l-4 border-orange-500 hover:border-orange-600">
                    <div class="flex items-center gap-3">
                        <div class="bg-orange-500 p-2 rounded-lg group-hover:scale-110 transition-transform">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-black group-hover:text-black">Kelola Berita</span>
                    </div>
                    <svg class="w-5 h-5 text-orange-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ route('admin.kontak.index') }}" class="flex items-center justify-between p-4 bg-red-50 hover:bg-red-100 rounded-xl transition-all group border-l-4 border-red-500 hover:border-red-600">
                    <div class="flex items-center gap-3">
                        <div class="bg-red-500 p-2 rounded-lg group-hover:scale-110 transition-transform">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-black group-hover:text-black">Kelola Pesan Kontak</span>
                    </div>
                    <svg class="w-5 h-5 text-red-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Real-time clock
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
    }
    
    setInterval(updateClock, 1000);
    updateClock();
</script>
@endpush
@endsection