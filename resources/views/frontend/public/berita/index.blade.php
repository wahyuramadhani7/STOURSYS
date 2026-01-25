@extends('frontend.layout.app')

@section('title', 'Berita Terbaru - STOURSYS')

@section('content')
    <!-- Header - Horizontal Layout -->
    <section class="py-16 bg-gradient-to-r from-orange-50 via-white to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <!-- Left Side -->
                <div class="flex-1">
                    <div class="inline-block mb-3 px-4 py-2 bg-orange-100 rounded-full border border-orange-200">
                        <span class="text-orange-600 text-sm font-semibold">Berita & Informasi</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-3 tracking-tight">
                        Berita Terbaru <span class="bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">Kawasan Borobudur</span>
                    </h1>
                </div>
                
                <!-- Right Side -->
                <div class="flex-shrink-0 md:max-w-md">
                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                        Update terkini seputar wisata, budaya, dan perkembangan kawasan candi Borobudur
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($beritas as $berita)
                    <div class="group relative bg-white rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-200/50">
                        <!-- Gambar -->
                        <div class="relative h-64 overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800">
                            @if($berita->gambar_utama)
                                <img 
                                    src="{{ $berita->gambar_utama_url }}" 
                                    alt="{{ $berita->judul }}" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0"></div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-800 via-blue-900 to-orange-900 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Badge -->
                            <div class="absolute top-4 right-4 bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                Terbaru
                            </div>
                        </div>

                        <!-- Konten -->
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-orange-600 transition-colors leading-tight line-clamp-2">
                                {{ $berita->judul }}
                            </h3>
                            
                            <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                {{ Str::limit($berita->excerpt, 110) }}
                            </p>

                            <!-- Info Berita -->
                            <div class="mb-6 space-y-2 text-sm">
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>{{ $berita->penulis ?? 'Admin' }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $berita->tanggal_publikasi?->format('d F Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span>{{ $berita->views }} kali dilihat</span>
                                </div>
                            </div>

                            <a href="{{ route('berita.show', $berita->id) }}"
                               class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 group/btn">
                                <span>Baca Selengkapnya</span>
                                <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 bg-gradient-to-br from-orange-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <span class="text-5xl">📰</span>
                            </div>
                            
                            <h3 class="text-3xl font-bold text-slate-900 mb-3">
                                Belum Ada Berita
                            </h3>
                            
                            <p class="text-gray-600 text-lg">
                                Berita terbaru akan segera hadir. Nantikan update dari kami!
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(method_exists($beritas ?? null, 'links'))
                <div class="mt-12 flex justify-center">
                    {{ $beritas->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection