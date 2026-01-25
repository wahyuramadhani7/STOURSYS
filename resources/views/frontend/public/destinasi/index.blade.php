@extends('frontend.layout.app')

@section('title', 'Destinasi Wisata Kawasan Borobudur - STOURSYS')

@section('content')

    <!-- Header -->
    <section class="py-16 bg-gradient-to-r from-orange-50 via-white to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="flex-1">
                    <div class="inline-block mb-3 px-4 py-2 bg-orange-100 rounded-full border border-orange-200">
                        <span class="text-orange-600 text-sm font-semibold">Explore Borobudur</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-3 tracking-tight">
                        Destinasi Wisata <span class="bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">Kawasan Borobudur</span>
                    </h1>
                </div>
                <div class="flex-shrink-0 md:max-w-md">
                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                        Temukan keindahan dan keajaiban destinasi wisata terbaik di kawasan candi Borobudur yang memukau
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Destinasi + Search (super compact) -->
    <section class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Search Bar - Sangat kecil -->
            <div class="mb-6">
                <form method="GET" action="{{ route('destinasi.index') }}" class="max-w-sm mx-auto">
                    <div class="relative flex items-center">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Cari destinasi..." 
                            class="w-full px-4 py-2 pr-24 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 shadow-sm text-sm transition-all"
                        >
                        <div class="absolute right-1 flex items-center gap-1">
                            <button type="submit" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-3.5 py-1.5 rounded-full font-medium hover:from-orange-600 hover:to-orange-700 transition-all shadow hover:shadow-md flex items-center gap-1 text-xs">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('destinasi.index') }}" 
                                   class="text-gray-500 hover:text-orange-600 transition-colors text-xs px-2">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

                @if(request('search'))
                    <p class="text-center mt-2 text-gray-500 text-xs">
                        "{{ request('search') }}" • {{ $destinasi->total() }} hasil
                    </p>
                @endif
            </div>

            <!-- Grid Destinasi -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($destinasi as $item)
                    <div class="group relative bg-white rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-200/50">
                        <div class="relative h-64 overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800">
                            @if($item->gambar_utama)
                                <img 
                                    src="{{ Storage::url($item->gambar_utama) }}" 
                                    alt="{{ $item->nama }}" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0"></div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-800 via-blue-900 to-orange-900 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="absolute top-4 right-4 bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                Populer
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-orange-600 transition-colors leading-tight">
                                {{ $item->nama }}
                            </h3>
                            
                            <p class="text-gray-600 mb-5 line-clamp-3 leading-relaxed text-sm">
                                {{ Str::limit(strip_tags($item->deskripsi ?? ''), 100) }}
                            </p>

                            <a href="{{ route('destinasi.show', $item->slug ?? $item->id) }}"
                               class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-5 py-2.5 rounded-xl font-semibold transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-1 group/btn text-sm">
                                <span>Jelajahi</span>
                                <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="max-w-md mx-auto">
                            <div class="w-20 h-20 bg-gradient-to-br from-orange-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-5">
                                <span class="text-4xl">🏯</span>
                            </div>
                            
                            <h3 class="text-2xl font-bold text-slate-900 mb-3">
                                @if(request('search'))
                                    Tidak ditemukan "{{ request('search') }}"
                                @else
                                    Belum Ada Destinasi
                                @endif
                            </h3>
                            
                            <p class="text-gray-600 text-sm mb-6">
                                @if(request('search'))
                                    Coba kata lain atau reset.
                                @else
                                    Destinasi akan segera tersedia.
                                @endif
                            </p>

                            @if(request('search'))
                                <a href="{{ route('destinasi.index') }}" 
                                   class="inline-block bg-orange-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-orange-700 transition-all shadow-md text-sm">
                                    Lihat Semua
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($destinasi->hasPages())
                <div class="mt-10 flex justify-center">
                    {{ $destinasi->links('pagination::tailwind') }}
                </div>
            @endif

        </div>
    </section>

@endsection