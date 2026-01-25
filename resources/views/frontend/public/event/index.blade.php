@extends('frontend.layout.app')

@section('title', 'Event & Kegiatan - STOURSYS')

@section('content')
    <!-- Header -->
    <section class="py-16 bg-gradient-to-r from-orange-50 via-white to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="flex-1">
                    <div class="inline-block mb-3 px-4 py-2 bg-orange-100 rounded-full border border-orange-200">
                        <span class="text-orange-600 text-sm font-semibold">Event & Kegiatan</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-3 tracking-tight">
                        Event & Kegiatan <span class="bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">Kawasan Borobudur</span>
                    </h1>
                </div>
                <div class="flex-shrink-0 md:max-w-md">
                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                        Ikuti berbagai acara budaya, festival, dan kegiatan menarik di sekitar Borobudur
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Event + Search -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Search Bar (ukuran compact) -->
            <div class="mb-8">
                <form method="GET" action="{{ route('event.index') }}" class="max-w-md mx-auto">
                    <div class="relative flex items-center">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Cari event atau lokasi..." 
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
                                <a href="{{ route('event.index') }}" 
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
                        ({{ $events->total() }} event)
                    </p>
                @endif
            </div>

            <!-- Grid Event -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($events as $event)
                    @php
                        $statusClass = match ($event->status) {
                            'Sedang Berlangsung' => 'bg-green-500 text-white',
                            'Akan Datang' => 'bg-blue-500 text-white',
                            default => 'bg-gray-500 text-white',
                        };
                    @endphp

                    <div class="group relative bg-white rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-200/50">
                        <!-- Gambar -->
                        <div class="relative h-64 overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800">
                            @if($event->gambar_utama)
                                <img 
                                    src="{{ Storage::url($event->gambar_utama) }}" 
                                    alt="{{ $event->judul }}" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0"></div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-800 via-blue-900 to-orange-900 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="absolute top-4 right-4 {{ $statusClass }} px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                {{ $event->status }}
                            </div>
                        </div>

                        <!-- Konten -->
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-orange-600 transition-colors leading-tight">
                                {{ $event->judul }}
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed text-sm">
                                {{ Str::limit($event->deskripsi ?? '', 110) }}
                            </p>

                            <!-- Info Event -->
                            <div class="mb-6 space-y-2 text-sm text-gray-600">
                                <div class="flex items-start gap-2">
                                    <svg class="w-5 h-5 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>
                                        {{ $event->tanggal_mulai->format('d M Y') }}
                                        @if ($event->tanggal_selesai)
                                            - {{ $event->tanggal_selesai->format('d M Y') }}
                                        @endif
                                    </span>
                                </div>

                                @if ($event->lokasi)
                                    <div class="flex items-start gap-2">
                                        <svg class="w-5 h-5 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>{{ $event->lokasi }}</span>
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('event.show', $event->id) }}"
                               class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 group/btn text-sm">
                                <span>Detail Event</span>
                                <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 bg-gradient-to-br from-orange-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <span class="text-5xl">📅</span>
                            </div>
                            
                            <h3 class="text-3xl font-bold text-slate-900 mb-3">
                                @if(request('search'))
                                    Tidak menemukan event untuk "{{ request('search') }}"
                                @else
                                    Belum Ada Event
                                @endif
                            </h3>
                            
                            <p class="text-gray-600 text-lg mb-6">
                                @if(request('search'))
                                    Coba kata kunci lain atau reset pencarian.
                                @else
                                    Belum ada event yang dijadwalkan saat ini. Pantau terus untuk update!
                                @endif
                            </p>

                            @if(request('search'))
                                <a href="{{ route('event.index') }}" 
                                   class="inline-block bg-orange-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-orange-700 transition-all shadow-lg">
                                    Lihat Semua Event
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($events->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $events->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </section>
@endsection