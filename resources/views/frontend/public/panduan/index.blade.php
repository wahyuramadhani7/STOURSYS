@extends('frontend.layout.app')

@section('title', 'Informasi Wisata & Darurat - STOURSYS')

@section('content')
    <!-- Header -->
    <section class="py-16 bg-gradient-to-r from-orange-50 via-white to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="flex-1">
                    <div class="inline-block mb-3 px-4 py-2 bg-orange-100 rounded-full border border-orange-200">
                        <span class="text-orange-600 text-sm font-semibold">Informasi Daerah</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-3 tracking-tight">
                        Panduan </span>
                    </h1>
                </div>
                
                <div class="flex-shrink-0 md:max-w-md">
                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                        Temukan hotel, rumah sakit, BPBD, layanan darurat, dan informasi lainnya untuk wisata aman dan nyaman di Kawasan Borobudur.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter + Search -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Filter Kategori + Search -->
            <div class="mb-10">
                <form method="GET" action="{{ route('panduan.index') }}" class="flex flex-col sm:flex-row gap-4 max-w-4xl mx-auto">
                    <!-- Dropdown Kategori -->
                    <div class="relative flex-1">
                        <select name="kategori" 
                                onchange="this.form.submit()"
                                class="w-full px-5 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 shadow-sm text-base transition-all appearance-none bg-white pr-10">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ strtolower($kat) }}" {{ request('kategori') == strtolower($kat) ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Search Bar -->
                    <div class="relative flex-1">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Cari nama tempat atau layanan..." 
                            class="w-full px-5 py-3 pr-28 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 shadow-sm text-base transition-all"
                        >
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 flex items-center gap-2">
                            <button type="submit" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-5 py-2.5 rounded-full font-medium hover:from-orange-600 hover:to-orange-700 transition-all shadow-md hover:shadow-lg flex items-center gap-1.5 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Cari
                            </button>
                            @if(request('search') || request('kategori'))
                                <a href="{{ route('panduan.index') }}" 
                                   class="text-gray-600 hover:text-orange-600 transition-colors px-3 py-2.5 text-sm">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

                @if(request('search') || request('kategori'))
                    <p class="text-center mt-4 text-gray-600 text-sm">
                        Menampilkan <strong class="text-orange-600">{{ $panduans->total() }}</strong> 
                        @if(request('kategori'))
                            informasi kategori <strong class="text-orange-600">{{ ucfirst(request('kategori')) }}</strong>
                        @endif
                        @if(request('search'))
                            untuk "<strong class="text-orange-600">{{ request('search') }}</strong>"
                        @endif
                    </p>
                @endif
            </div>

            <!-- List Informasi -->
            <div class="space-y-6">
                @forelse ($panduans as $panduan)
                    <div class="group relative bg-white rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-200/50">
                        <div class="p-6 md:p-8">
                            <div class="flex flex-col md:flex-row items-start gap-6">
                                <!-- Gambar -->
                                @if($panduan->gambar)
                                    <div class="flex-shrink-0 w-full md:w-40 lg:w-48">
                                        <div class="relative h-56 md:h-40 lg:h-48 overflow-hidden rounded-xl bg-gradient-to-br from-slate-900 to-slate-800 shadow-lg">
                                            <img 
                                                src="{{ Storage::url($panduan->gambar) }}" 
                                                alt="{{ $panduan->judul }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                            >
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent"></div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex-shrink-0 w-full md:w-40 lg:w-48">
                                        <div class="h-56 md:h-40 lg:h-48 bg-gradient-to-br from-slate-800 via-blue-900 to-orange-900 rounded-xl flex items-center justify-center shadow-lg">
                                            <svg class="w-20 h-20 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                @endif

                                <!-- Konten -->
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-start justify-between gap-4 mb-3">
                                        <h3 class="text-2xl md:text-3xl font-bold text-slate-900 group-hover:text-orange-600 transition-colors leading-tight">
                                            {{ $panduan->judul }}
                                        </h3>
                                        
                                        <span class="flex-shrink-0 px-4 py-1.5 rounded-full text-sm font-bold shadow-md
                                            {{ $panduan->kategori == 'hotel' ? 'bg-green-500 text-white' : '' }}
                                            {{ $panduan->kategori == 'pemerintahan' ? 'bg-blue-500 text-white' : '' }}
                                            {{ $panduan->kategori == 'rumah_sakit' ? 'bg-red-500 text-white' : '' }}
                                            {{ $panduan->kategori == 'darurat' ? 'bg-orange-500 text-white' : '' }}
                                            {{ $panduan->kategori == 'lainnya' ? 'bg-gray-500 text-white' : '' }}">
                                            {{ ucfirst($panduan->kategori ?? 'Informasi') }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed text-base md:text-lg">
                                        {{ Str::limit(strip_tags($panduan->isi ?? ''), 180) }}
                                    </p>

                                    <div class="flex flex-wrap gap-4 text-sm text-gray-700 mb-6">
                                        @if($panduan->alamat)
                                            <div class="flex items-center gap-2">
                                                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                <span>{{ Str::limit($panduan->alamat, 60) }}</span>
                                            </div>
                                        @endif

                                        @if($panduan->kontak)
                                            <div class="flex items-center gap-2">
                                                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                <span>{{ $panduan->kontak }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <a href="{{ route('panduan.show', $panduan->id) }}"
                                       class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 group/btn text-sm">
                                        <span>Lihat Detail</span>
                                        <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-24">
                        <div class="max-w-md mx-auto">
                            <div class="w-28 h-28 bg-gradient-to-br from-orange-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                                <span class="text-6xl">🔍</span>
                            </div>
                            
                            <h3 class="text-3xl font-bold text-slate-900 mb-4">
                                @if(request('search') || request('kategori'))
                                    Tidak ditemukan informasi yang sesuai
                                @else
                                    Belum Ada Informasi Tersedia
                                @endif
                            </h3>
                            
                            <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                                @if(request('search'))
                                    Coba cari dengan kata kunci lain atau reset filter.
                                @elseif(request('kategori'))
                                    Kategori ini belum memiliki data. Silakan cek kategori lain.
                                @else
                                    Informasi hotel, rumah sakit, BPBD, dan layanan penting akan segera ditambahkan. Terima kasih atas kesabaran Anda!
                                @endif
                            </p>

                            <a href="{{ route('panduan.index') }}" 
                               class="inline-block bg-gradient-to-r from-orange-500 to-orange-600 text-white px-10 py-4 rounded-xl font-bold hover:from-orange-600 hover:to-orange-700 transition-all shadow-xl hover:shadow-2xl">
                                Lihat Semua Informasi
                            </a>
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