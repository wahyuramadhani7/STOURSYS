@extends('frontend.layout.app')

@section('title', 'Panduan Penggunaan - STOURSYS')

@section('content')
    <!-- Header -->
    <section class="py-16 bg-gradient-to-r from-orange-50 via-white to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="flex-1">
                    <div class="inline-block mb-3 px-4 py-2 bg-orange-100 rounded-full border border-orange-200">
                        <span class="text-orange-600 text-sm font-semibold">Panduan & Tutorial</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-3 tracking-tight">
                        Panduan Penggunaan <span class="bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">Smart Tourism System</span>
                    </h1>
                </div>
                
                <div class="flex-shrink-0 md:max-w-md">
                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                        Pelajari cara menggunakan sistem informasi wisata untuk pengalaman terbaik Anda
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Panduan + Search -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Search Bar - Ukuran kecil & ramping -->
            <div class="mb-8">
                <form method="GET" action="{{ route('panduan.index') }}" class="max-w-md mx-auto">
                    <div class="relative flex items-center">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Cari panduan..." 
                            class="w-full px-5 py-3 pr-28 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 shadow-sm text-base transition-all"
                        >
                        <div class="absolute right-2 flex items-center gap-2">
                            <button type="submit" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-5 py-2.5 rounded-full font-medium hover:from-orange-600 hover:to-orange-700 transition-all shadow-md hover:shadow-lg flex items-center gap-1.5 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('panduan.index') }}" 
                                   class="text-gray-600 hover:text-orange-600 transition-colors px-3 py-2.5 text-sm">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

                @if(request('search'))
                    <p class="text-center mt-3 text-gray-600 text-sm">
                        Hasil untuk <strong class="text-orange-600">"{{ request('search') }}"</strong> 
                        ({{ $panduans->total() }} panduan)
                    </p>
                @endif
            </div>

            <!-- List Panduan -->
            <div class="space-y-6">
                @forelse ($panduans as $panduan)
                    <div class="group relative bg-white rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-200/50">
                        <div class="p-6 md:p-8">
                            <div class="flex flex-col md:flex-row items-start gap-6">
                                <!-- Gambar -->
                                @if($panduan->gambar)
                                    <div class="flex-shrink-0 w-full md:w-32 lg:w-40">
                                        <div class="relative h-48 md:h-32 lg:h-40 overflow-hidden rounded-xl bg-gradient-to-br from-slate-900 to-slate-800">
                                            <img 
                                                src="{{ Storage::url($panduan->gambar) }}" 
                                                alt="{{ $panduan->judul }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                            >
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-black/0 to-black/0"></div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex-shrink-0 w-full md:w-32 lg:w-40">
                                        <div class="h-48 md:h-32 lg:h-40 bg-gradient-to-br from-slate-800 via-blue-900 to-orange-900 rounded-xl flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                    </div>
                                @endif

                                <!-- Konten -->
                                <div class="flex-1">
                                    <div class="flex items-start justify-between gap-4 mb-3">
                                        <h3 class="text-2xl md:text-3xl font-bold text-slate-900 group-hover:text-orange-600 transition-colors leading-tight">
                                            {{ $panduan->judul }}
                                        </h3>
                                        
                                        <div class="flex-shrink-0 bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                            Guide
                                        </div>
                                    </div>
                                    
                                    <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed text-base md:text-lg">
                                        {{ Str::limit(strip_tags($panduan->isi ?? ''), 200) }}
                                    </p>

                                    <a href="{{ route('panduan.show', $panduan->id) }}"
                                       class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 group/btn text-sm">
                                        <span>Baca Panduan</span>
                                        <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 bg-gradient-to-br from-orange-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <span class="text-5xl">📖</span>
                            </div>
                            
                            <h3 class="text-3xl font-bold text-slate-900 mb-3">
                                @if(request('search'))
                                    Tidak menemukan panduan untuk "{{ request('search') }}"
                                @else
                                    Belum Ada Panduan
                                @endif
                            </h3>
                            
                            <p class="text-gray-600 text-lg mb-6">
                                @if(request('search'))
                                    Coba kata kunci lain atau reset pencarian.
                                @else
                                    Panduan penggunaan akan segera tersedia. Nantikan update dari kami!
                                @endif
                            </p>

                            @if(request('search'))
                                <a href="{{ route('panduan.index') }}" 
                                   class="inline-block bg-orange-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-orange-700 transition-all shadow-lg">
                                    Lihat Semua Panduan
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($panduans->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $panduans->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </section>
@endsection