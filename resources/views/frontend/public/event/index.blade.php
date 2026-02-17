@extends('frontend.layout.app')

@section('title', 'Event & Kegiatan - STOURSYS')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    /* Floating animation */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }
    
    /* Pulse glow animation */
    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 20px rgba(249, 115, 22, 0.4); }
        50% { box-shadow: 0 0 30px rgba(249, 115, 22, 0.6); }
    }
    
    /* Shimmer effect */
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }
    
    /* Gradient animation */
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    /* Status badge pulse */
    @keyframes badgePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    /* Bounce subtle */
    @keyframes bounceSubtle {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    .animate-pulse-glow {
        animation: pulseGlow 2s ease-in-out infinite;
    }
    
    .shimmer-effect {
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        background-size: 1000px 100%;
        animation: shimmer 2s infinite;
    }
    
    .animate-gradient {
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }
    
    .badge-pulse {
        animation: badgePulse 2s ease-in-out infinite;
    }
    
    /* Event card hover effects */
    .event-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    
    .event-card::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(45deg, #f97316, #fb923c, #fdba74);
        border-radius: 1rem;
        opacity: 0;
        transition: opacity 0.4s;
        z-index: -1;
        filter: blur(10px);
    }
    
    .event-card:hover::before {
        opacity: 0.5;
    }
    
    .event-card:hover {
        transform: translateY(-12px) scale(1.02);
    }
    
    /* Image zoom with perspective */
    .image-container {
        perspective: 1000px;
    }
    
    .image-zoom {
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .event-card:hover .image-zoom {
        transform: scale(1.15) rotateZ(2deg);
    }
    
    /* Status badge animation */
    .status-badge {
        transition: all 0.3s ease;
    }
    
    .event-card:hover .status-badge {
        transform: scale(1.15) rotate(5deg);
    }
    
    /* Info icon effects */
    .info-icon {
        transition: all 0.3s ease;
    }
    
    .info-item:hover .info-icon {
        transform: scale(1.2) rotate(10deg);
    }
    
    .info-item {
        transition: all 0.3s ease;
    }
    
    .info-item:hover {
        color: #f97316;
        transform: translateX(3px);
    }
    
    /* Button hover effect */
    .detail-button {
        position: relative;
        overflow: hidden;
    }
    
    .detail-button::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    
    .detail-button:hover::before {
        width: 300px;
        height: 300px;
    }
    
    /* Search input focus effect */
    .search-input {
        position: relative;
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        transform: scale(1.02);
    }
    
    /* Empty state animation */
    .empty-icon {
        animation: bounceSubtle 2s ease-in-out infinite;
    }
    
    /* Date display animation */
    .date-display {
        position: relative;
        display: inline-block;
    }
    
    .date-display::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #f97316, #fb923c);
        transition: width 0.3s ease;
    }
    
    .info-item:hover .date-display::after {
        width: 100%;
    }
    
    /* Location pin animation */
    .location-pin {
        transition: all 0.3s ease;
    }
    
    .info-item:hover .location-pin {
        animation: float 1s ease-in-out;
    }
    
    /* Stagger delays */
    .stagger-1 { animation-delay: 0.1s; }
    .stagger-2 { animation-delay: 0.2s; }
    .stagger-3 { animation-delay: 0.3s; }
    
    /* Title hover gradient */
    .event-title {
        background: linear-gradient(90deg, #1e293b, #1e293b);
        background-clip: text;
        -webkit-background-clip: text;
        transition: all 0.4s ease;
    }
    
    .event-card:hover .event-title {
        background: linear-gradient(90deg, #f97316, #fb923c);
        -webkit-text-fill-color: transparent;
    }
    
    /* Card glow effect for ongoing events */
    .glow-green {
        box-shadow: 0 0 20px rgba(34, 197, 94, 0.3);
    }
    
    .glow-blue {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    }
    
    /* Pagination hover */
    .pagination-link {
        transition: all 0.3s ease;
    }
    
    .pagination-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
    }

    /* Recurring badge style */
    .recurring-badge {
        background: linear-gradient(135deg, #f97316, #fb923c);
        color: white;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4);
    }

    .recurring-icon {
        animation: spin 8s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }

    /* Highlight recurring card */
    .is-recurring {
        border: 2px solid #f97316;
        background: linear-gradient(to bottom right, rgba(249, 115, 22, 0.03), rgba(251, 146, 60, 0.03));
    }

    .is-recurring .event-title {
        background: linear-gradient(90deg, #f97316, #fb923c, #fdba74);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Filter buttons */
    .filter-btn {
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .filter-btn.active {
        background: linear-gradient(to right, #f97316, #fb923c) !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(249, 115, 22, 0.35) !important;
    }

    .filter-btn:hover:not(.active) {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    .filter-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
    }

    .filter-container::-webkit-scrollbar {
        height: 6px;
    }

    .filter-container::-webkit-scrollbar-thumb {
        background: rgba(249, 115, 22, 0.4);
        border-radius: 3px;
    }
</style>
@endpush

@section('content')
    <!-- Header -->
    <section class="py-16 bg-gradient-to-r from-orange-50 via-white to-blue-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="flex-1" data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-block mb-3 px-4 py-2 bg-orange-100 rounded-full border border-orange-200 animate-pulse-glow">
                        <span class="text-orange-600 text-sm font-semibold">Event & Kegiatan</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-3 tracking-tight">
                        Event & Kegiatan <span class="bg-gradient-to-r from-orange-500 via-orange-600 to-orange-500 bg-clip-text text-transparent animate-gradient">Kawasan Borobudur</span>
                    </h1>
                </div>
                <div class="flex-shrink-0 md:max-w-md" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                        Ikuti berbagai acara budaya, festival, dan kegiatan menarik di sekitar Borobudur
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter + Search -->
    <section class="py-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <!-- Filter Buttons -->
                <div class="filter-container">
                    <div class="flex gap-3 pb-2">
                        <a href="{{ route('event.index', request()->except('filter')) }}"
                           class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition-all {{ !request()->has('filter') ? 'active' : '' }}">
                            Semua Event
                        </a>

                        <a href="{{ route('event.index', array_merge(request()->query(), ['filter' => 'rutin'])) }}"
                           class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium bg-orange-50 text-orange-700 hover:bg-orange-100 transition-all {{ request('filter') === 'rutin' ? 'active' : '' }}">
                            Event Rutin
                        </a>

                        <a href="{{ route('event.index', array_merge(request()->query(), ['filter' => 'ongoing'])) }}"
                           class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium bg-green-50 text-green-700 hover:bg-green-100 transition-all {{ request('filter') === 'ongoing' ? 'active' : '' }}">
                            Sedang Berlangsung
                        </a>

                        <a href="{{ route('event.index', array_merge(request()->query(), ['filter' => 'upcoming'])) }}"
                           class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 transition-all {{ request('filter') === 'upcoming' ? 'active' : '' }}">
                            Akan Datang
                        </a>

                        <a href="{{ route('event.index', array_merge(request()->query(), ['filter' => 'past'])) }}"
                           class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium bg-gray-50 text-gray-700 hover:bg-gray-200 transition-all {{ request('filter') === 'past' ? 'active' : '' }}">
                            Sudah Berakhir
                        </a>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="w-full lg:w-auto" data-aos="fade-left" data-aos-duration="800">
                    <form method="GET" action="{{ route('event.index') }}" class="max-w-md">
                        <div class="relative flex items-center">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Cari event atau lokasi..." 
                                class="search-input w-full px-5 py-3 pr-28 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 shadow-sm text-base transition-all hover:shadow-md"
                            >
                            <input type="hidden" name="filter" value="{{ request('filter') }}">
                            <div class="absolute right-2 flex items-center gap-2">
                                <button type="submit" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-5 py-2.5 rounded-full font-medium hover:from-orange-600 hover:to-orange-700 transition-all shadow-md hover:shadow-lg flex items-center gap-1.5 text-sm transform hover:scale-105 active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Cari
                                </button>
                                @if(request('search') || request('filter'))
                                    <a href="{{ route('event.index') }}" 
                                       class="text-gray-600 hover:text-orange-600 transition-all px-3 py-2.5 text-sm transform hover:scale-110">
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Status Filter Aktif -->
            @if(request('filter') || request('search'))
                <div class="mt-4 text-center text-gray-600 text-sm" data-aos="fade-in">
                    Menampilkan: 
                    <span class="font-medium text-orange-600">
                        @if(request('filter') === 'rutin') Event Rutin
                        @elseif(request('filter') === 'ongoing') Sedang Berlangsung
                        @elseif(request('filter') === 'upcoming') Akan Datang
                        @elseif(request('filter') === 'past') Sudah Berakhir
                        @else Semua Event @endif
                    </span>
                    @if(request('search'))
                        untuk pencarian <strong>"{{ request('search') }}"</strong>
                    @endif
                    ({{ $events->total() }} event)
                </div>
            @endif
        </div>
    </section>

    <!-- Daftar Event -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($events as $index => $event)
                    @php
                        $statusClass = match ($event->status) {
                            'Sedang Berlangsung' => 'bg-green-500 text-white',
                            'Akan Datang' => 'bg-blue-500 text-white',
                            default => 'bg-gray-500 text-white',
                        };
                        
                        $cardGlow = match ($event->status) {
                            'Sedang Berlangsung' => 'glow-green',
                            'Akan Datang' => 'glow-blue',
                            default => '',
                        };

                        $isRecurring = $event->isRecurring();
                    @endphp

                    <div class="event-card {{ $cardGlow }} {{ $isRecurring ? 'is-recurring' : '' }} group relative bg-white rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-200/50"
                         data-aos="fade-up" 
                         data-aos-duration="800" 
                         data-aos-delay="{{ $index * 100 }}">
                        <!-- Gambar -->
                        <div class="image-container relative h-64 overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800">
                            @if($event->gambar_utama)
                                <img 
                                    src="{{ Storage::url($event->gambar_utama) }}" 
                                    alt="{{ $event->judul }}" 
                                    class="image-zoom w-full h-full object-cover"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0"></div>
                                <div class="absolute inset-0 shimmer-effect opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-800 via-blue-900 to-orange-900 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white/20 animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="status-badge absolute top-4 right-4 {{ $statusClass }} px-3 py-1 rounded-full text-xs font-bold shadow-lg {{ $event->status === 'Sedang Berlangsung' ? 'badge-pulse' : '' }}">
                                {{ $event->status }}
                            </div>

                            @if($isRecurring)
                                <div class="recurring-badge absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-bold shadow-lg flex items-center gap-1.5 badge-pulse">
                                    <svg class="w-4 h-4 recurring-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Rutin
                                </div>
                            @endif
                        </div>

                        <!-- Konten -->
                        <div class="p-6">
                            <h3 class="event-title text-2xl font-bold text-slate-900 mb-3 transition-colors leading-tight">
                                {{ $event->judul }}
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed text-sm">
                                {{ Str::limit($event->deskripsi ?? '', 110) }}
                            </p>

                            <!-- Info Event -->
                            <div class="mb-6 space-y-2 text-sm text-gray-600">
                                <div class="info-item flex items-start gap-2">
                                    <svg class="info-icon w-5 h-5 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="date-display">
                                        {{ $event->tanggal_range }}
                                        @if($event->jam_range && $event->jam_range !== '-')
                                            • {{ $event->jam_range }}
                                        @endif
                                    </span>
                                </div>

                                @if ($event->lokasi)
                                    <div class="info-item flex items-start gap-2">
                                        <svg class="info-icon location-pin w-5 h-5 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>{{ $event->lokasi }}</span>
                                    </div>
                                @endif

                                @if($isRecurring)
                                    <div class="info-item flex items-start gap-2 text-orange-600 font-medium">
                                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                        <span>Event ini berulang secara rutin</span>
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('event.show', $event->slug) }}"
                               class="detail-button inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 group/btn text-sm relative overflow-hidden transform active:scale-95">
                                <span class="relative z-10">Detail Event</span>
                                <svg class="relative z-10 w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20" data-aos="fade-up" data-aos-duration="1000">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 bg-gradient-to-br from-orange-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 empty-icon">
                                <span class="text-5xl">📅</span>
                            </div>
                            
                            <h3 class="text-3xl font-bold text-slate-900 mb-3">
                                @if(request('search') || request('filter'))
                                    Tidak menemukan event sesuai filter
                                @else
                                    Belum Ada Event
                                @endif
                            </h3>
                            
                            <p class="text-gray-600 text-lg mb-6">
                                @if(request('search') || request('filter'))
                                    Coba ubah kata kunci atau pilih filter lain.
                                @else
                                    Belum ada event yang dijadwalkan saat ini. Pantau terus untuk update!
                                @endif
                            </p>

                            <a href="{{ route('event.index') }}" 
                               class="inline-block bg-orange-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-orange-700 transition-all shadow-lg transform hover:scale-105 active:scale-95">
                                Reset Filter
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($events->hasPages())
                <div class="mt-12 flex justify-center" data-aos="fade-up" data-aos-duration="800">
                    {{ $events->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init({
        once: true,
        mirror: false,
        duration: 800,
        easing: 'ease-out-cubic',
    });
    
    // Highlight active filter button (redundant safety)
    document.querySelectorAll('.filter-btn').forEach(btn => {
        if (btn.href === window.location.href) {
            btn.classList.add('active');
        }
    });
    
    // Add dynamic countdown for ongoing events
    document.querySelectorAll('.event-card').forEach(card => {
        const statusBadge = card.querySelector('.status-badge');
        if (statusBadge && statusBadge.textContent.includes('Sedang Berlangsung')) {
            card.style.borderColor = 'rgba(34, 197, 94, 0.3)';
        }
    });
    
    // Smooth scroll for pagination
    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', function(e) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
    
    // Hover effects enhancement
    const cards = document.querySelectorAll('.event-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
        });
    });
</script>
@endpush