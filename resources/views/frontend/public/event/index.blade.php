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

    @keyframes spin {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
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

    /* ==============================
       EVENT CARD
    ============================== */
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
    
    @media (hover: hover) {
        .event-card:hover::before {
            opacity: 0.5;
        }
        
        .event-card:hover {
            transform: translateY(-12px) scale(1.02);
        }

        .event-card:hover .image-zoom {
            transform: scale(1.15) rotateZ(2deg);
        }

        .event-card:hover .status-badge {
            transform: scale(1.15) rotate(5deg);
        }

        .info-item:hover .info-icon {
            transform: scale(1.2) rotate(10deg);
        }

        .info-item:hover {
            color: #f97316;
            transform: translateX(3px);
        }

        .info-item:hover .date-display::after {
            width: 100%;
        }

        .info-item:hover .location-pin {
            animation: float 1s ease-in-out;
        }

        .event-card:hover .event-title {
            background: linear-gradient(90deg, #f97316, #fb923c);
            -webkit-text-fill-color: transparent;
        }

        .filter-btn:hover:not(.active) {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .pagination-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
        }
    }
    
    .image-container {
        perspective: 1000px;
    }
    
    .image-zoom {
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .status-badge {
        transition: all 0.3s ease;
    }
    
    .info-icon {
        transition: all 0.3s ease;
    }
    
    .info-item {
        transition: all 0.3s ease;
    }
    
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
    
    @media (hover: hover) {
        .detail-button:hover::before {
            width: 300px;
            height: 300px;
        }
    }
    
    .search-input {
        transition: all 0.3s ease;
    }
    
    @media (hover: hover) {
        .search-input:focus {
            transform: scale(1.02);
        }
    }
    
    .empty-icon {
        animation: bounceSubtle 2s ease-in-out infinite;
    }
    
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
    
    .glow-green {
        box-shadow: 0 0 20px rgba(34, 197, 94, 0.3);
    }
    
    .glow-blue {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    }
    
    .pagination-link {
        transition: all 0.3s ease;
    }

    .recurring-badge {
        background: linear-gradient(135deg, #f97316, #fb923c);
        color: white;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.4);
    }

    .recurring-icon {
        animation: spin 8s linear infinite;
    }

    .is-recurring {
        border: 2px solid #f97316;
        background: linear-gradient(to bottom right, rgba(249, 115, 22, 0.03), rgba(251, 146, 60, 0.03));
    }

    .is-recurring .event-title {
        background: linear-gradient(90deg, #f97316, #fb923c, #fdba74);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .event-title {
        background: linear-gradient(90deg, #1e293b, #1e293b);
        background-clip: text;
        -webkit-background-clip: text;
        transition: all 0.4s ease;
    }

    .filter-btn {
        transition: all 0.3s ease;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .filter-btn.active {
        background: linear-gradient(to right, #f97316, #fb923c) !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(249, 115, 22, 0.35) !important;
    }

    .filter-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        -ms-overflow-style: none;
        margin-left: -1rem;
        margin-right: -1rem;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .filter-container::-webkit-scrollbar {
        display: none;
    }

    @media (min-width: 1024px) {
        .filter-container {
            scrollbar-width: thin;
            margin-left: 0;
            margin-right: 0;
            padding-left: 0;
            padding-right: 0;
        }
        .filter-container::-webkit-scrollbar {
            display: block;
            height: 4px;
        }
        .filter-container::-webkit-scrollbar-thumb {
            background: rgba(249, 115, 22, 0.4);
            border-radius: 3px;
        }
    }

    .search-wrapper {
        position: relative;
        width: 100%;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1.25rem;
        padding-right: 7rem;
        border-radius: 9999px;
        border: 1px solid #d1d5db;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }

    .search-input:focus {
        outline: none;
        border-color: #fb923c;
        box-shadow: 0 0 0 3px rgba(249,115,22,0.15);
    }

    .search-actions {
        position: absolute;
        right: 6px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        align-items: center;
        gap: 2px;
    }

    .search-btn {
        background: linear-gradient(to right, #f97316, #ea580c);
        color: white;
        border: none;
        border-radius: 9999px;
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .search-btn:hover {
        background: linear-gradient(to right, #ea580c, #c2410c);
    }

    .reset-link {
        color: #6b7280;
        text-decoration: none;
        font-size: 0.78rem;
        padding: 0.4rem 0.5rem;
        border-radius: 9999px;
        transition: color 0.2s;
        white-space: nowrap;
    }

    .reset-link:hover {
        color: #f97316;
    }

    .card-image {
        height: 200px;
    }

    @media (min-width: 640px) {
        .card-image {
            height: 220px;
        }
    }

    @media (min-width: 1024px) {
        .card-image {
            height: 240px;
        }
    }

    .card-body {
        padding: 1rem;
    }

    @media (min-width: 640px) {
        .card-body {
            padding: 1.25rem;
        }
    }

    @media (min-width: 1024px) {
        .card-body {
            padding: 1.5rem;
        }
    }

    .event-title {
        font-size: 1.1rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 0.5rem;
        color: #1e293b;
    }

    @media (min-width: 640px) {
        .event-title {
            font-size: 1.2rem;
        }
    }

    @media (min-width: 1024px) {
        .event-title {
            font-size: 1.35rem;
        }
    }

    .status-badge,
    .recurring-badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.6rem;
        line-height: 1.4;
    }

    @media (min-width: 640px) {
        .status-badge,
        .recurring-badge {
            font-size: 0.7rem;
            padding: 0.3rem 0.75rem;
        }
    }
</style>
@endpush

@section('content')
    <!-- HEADER -->
    <section class="py-10 md:py-16 bg-gradient-to-r from-orange-50 via-white to-blue-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 md:gap-6">
                <div class="flex-1" data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-block mb-3 px-3 py-1.5 md:px-4 md:py-2 bg-orange-100 rounded-full border border-orange-200 animate-pulse-glow">
                        <span class="text-orange-600 text-xs md:text-sm font-semibold">Event & Kegiatan</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-black text-slate-900 mb-2 md:mb-3 tracking-tight leading-tight">
                        Event & Kegiatan
                        <span class="block sm:inline bg-gradient-to-r from-orange-500 via-orange-600 to-orange-500 bg-clip-text text-transparent animate-gradient">
                            Kawasan Borobudur
                        </span>
                    </h1>
                </div>
                <div class="flex-shrink-0 md:max-w-sm lg:max-w-md" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <p class="text-gray-600 text-sm md:text-base lg:text-lg leading-relaxed">
                        Ikuti berbagai acara budaya, festival, yoga, dan kegiatan menarik di sekitar Candi Borobudur
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FILTER + SEARCH -->
    <section class="py-5 md:py-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 lg:gap-6">

                <!-- Filter Buttons -->
                <div class="filter-container">
                    <div class="flex gap-2 sm:gap-3 pb-1">
                        <a href="{{ route('event.index') }}"
                           class="filter-btn px-4 py-2 sm:px-5 sm:py-2.5 rounded-full text-xs sm:text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition-all {{ !request()->has('filter') ? 'active' : '' }}">
                            Semua Event
                        </a>

                        <a href="{{ route('event.index', ['filter' => 'rutin'] + request()->except('filter')) }}"
                           class="filter-btn px-4 py-2 sm:px-5 sm:py-2.5 rounded-full text-xs sm:text-sm font-medium bg-orange-50 text-orange-700 hover:bg-orange-100 transition-all {{ request('filter') === 'rutin' ? 'active' : '' }}">
                            Event Rutin
                        </a>

                        <a href="{{ route('event.index', ['filter' => 'ongoing'] + request()->except('filter')) }}"
                           class="filter-btn px-4 py-2 sm:px-5 sm:py-2.5 rounded-full text-xs sm:text-sm font-medium bg-green-50 text-green-700 hover:bg-green-100 transition-all {{ request('filter') === 'ongoing' ? 'active' : '' }}">
                            Sedang Berlangsung
                        </a>

                        <a href="{{ route('event.index', ['filter' => 'upcoming'] + request()->except('filter')) }}"
                           class="filter-btn px-4 py-2 sm:px-5 sm:py-2.5 rounded-full text-xs sm:text-sm font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 transition-all {{ request('filter') === 'upcoming' ? 'active' : '' }}">
                            Akan Datang
                        </a>

                        <a href="{{ route('event.index', ['filter' => 'past'] + request()->except('filter')) }}"
                           class="filter-btn px-4 py-2 sm:px-5 sm:py-2.5 rounded-full text-xs sm:text-sm font-medium bg-gray-50 text-gray-700 hover:bg-gray-200 transition-all {{ request('filter') === 'past' ? 'active' : '' }}">
                            Sudah Berakhir
                        </a>
                    </div>
                </div>

                <!-- Search + Filter Info -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    @if(request('filter') || request('search'))
                        <div class="text-gray-600 text-xs sm:text-sm order-2 sm:order-1">
                            Menampilkan:
                            <span class="font-medium text-orange-600">
                                @if(request('filter') === 'rutin') Event Rutin
                                @elseif(request('filter') === 'ongoing') Sedang Berlangsung
                                @elseif(request('filter') === 'upcoming') Akan Datang
                                @elseif(request('filter') === 'past') Sudah Berakhir
                                @else Semua Event @endif
                            </span>
                            @if(request('search'))
                                untuk <strong>"{{ request('search') }}"</strong>
                            @endif
                            <span class="text-gray-400">({{ $events->total() }} event)</span>
                        </div>
                    @else
                        <div class="hidden sm:block order-1"></div>
                    @endif

                    <div class="w-full sm:w-auto sm:min-w-[280px] lg:min-w-[340px] order-1 sm:order-2" data-aos="fade-left" data-aos-duration="800">
                        <form method="GET" action="{{ route('event.index') }}">
                            <input type="hidden" name="filter" value="{{ request('filter') }}">
                            <div class="search-wrapper">
                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari event, lokasi, atau kegiatan..."
                                    class="search-input"
                                >
                                <div class="search-actions">
                                    @if(request('search') || request('filter'))
                                        <a href="{{ route('event.index') }}" class="reset-link">Reset</a>
                                    @endif
                                    <button type="submit" class="search-btn">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                        Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- DAFTAR EVENT -->
    <section class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-7 lg:gap-8">
                @forelse ($events as $index => $event)
                    @php
                        $statusClass = match ($event->status) {
                            'Sedang Berlangsung' => 'bg-green-600 text-white',
                            'Akan Datang'        => 'bg-blue-600 text-white',
                            'Telah Berakhir'     => 'bg-red-600 text-white',
                            default              => 'bg-gray-600 text-white',
                        };

                        $cardGlow = match ($event->status) {
                            'Sedang Berlangsung' => 'glow-green',
                            'Akan Datang'        => 'glow-blue',
                            default              => '',
                        };

                        $isRecurring = $event->event_type === 'recurring';
                    @endphp

                    <div class="event-card {{ $cardGlow }} {{ $isRecurring ? 'is-recurring' : '' }} group relative bg-white rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-200/50"
                         data-aos="fade-up"
                         data-aos-duration="800"
                         data-aos-delay="{{ min($index * 80, 400) }}">

                        <!-- Gambar -->
                        <div class="image-container card-image relative overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800">
                            @if($event->gambar_utama)
                                <img
                                    src="{{ Storage::url($event->gambar_utama) }}"
                                    alt="{{ $event->judul }}"
                                    class="image-zoom w-full h-full object-cover transition-transform duration-700"
                                    loading="lazy"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                                <div class="absolute inset-0 shimmer-effect opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-800 via-blue-900 to-orange-900 flex items-center justify-center">
                                    <svg class="w-16 h-16 md:w-20 md:h-20 text-white/20 animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif

                            <!-- Status Badge -->
                            <div class="status-badge absolute top-3 right-3 sm:top-4 sm:right-4 {{ $statusClass }} rounded-full font-bold shadow-lg {{ $event->status === 'Sedang Berlangsung' ? 'badge-pulse' : '' }}">
                                {{ $event->status }}
                            </div>

                            <!-- Recurring Badge -->
                            @if($isRecurring)
                                <div class="recurring-badge absolute top-3 left-3 sm:top-4 sm:left-4 rounded-full shadow-lg flex items-center gap-1 badge-pulse">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 recurring-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Rutin
                                </div>
                            @endif
                        </div>

                        <!-- Konten -->
                        <div class="card-body p-5 sm:p-6">
                            <h3 class="event-title text-lg sm:text-xl font-bold mb-3 line-clamp-2">
                                {{ $event->judul }}
                            </h3>

                            <p class="text-gray-600 mb-4 line-clamp-2 text-sm leading-relaxed">
                                {{ Str::limit($event->deskripsi ?? '', 90) }}
                            </p>

                            <!-- Info -->
                            <div class="space-y-2.5 text-sm text-gray-600 mb-5">
                                <!-- Tanggal / Jadwal -->
                                <div class="info-item flex items-start gap-2">
                                    <svg class="info-icon w-5 h-5 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="date-display">
                                        @if($isRecurring)
                                            {{ Str::limit($event->recurring_description ?? 'Jadwal rutin', 70) }}
                                        @else
                                            {{ $event->tanggal_range }}
                                            @if($event->jam_range && $event->jam_range !== '-')
                                                • {{ $event->jam_range }}
                                            @endif
                                        @endif
                                    </span>
                                </div>

                                <!-- Lokasi -->
                                @if($event->lokasi)
                                    <div class="info-item flex items-start gap-2">
                                        <svg class="info-icon location-pin w-5 h-5 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="line-clamp-1">{{ $event->lokasi }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Tombol Detail -->
                            <a href="{{ route('event.show', $event->slug) }}"
                               class="detail-button w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-md hover:shadow-xl hover:-translate-y-0.5 group/btn text-sm relative overflow-hidden">
                                <span class="relative z-10">Lihat Detail Event</span>
                                <svg class="relative z-10 w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 md:py-24 px-4" data-aos="fade-up" data-aos-duration="1000">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-orange-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 empty-icon">
                                <span class="text-5xl md:text-6xl">📅</span>
                            </div>

                            <h3 class="text-2xl md:text-3xl font-bold text-slate-900 mb-3">
                                @if(request('search') || request('filter'))
                                    Tidak ada event yang cocok
                                @else
                                    Belum Ada Event Saat Ini
                                @endif
                            </h3>

                            <p class="text-gray-600 text-base mb-6 md:mb-8">
                                @if(request('search') || request('filter'))
                                    Coba ubah kata kunci atau hapus filter untuk melihat event lainnya.
                                @else
                                    Saat ini belum ada event atau kegiatan yang dijadwalkan. Silakan pantau kembali nanti!
                                @endif
                            </p>

                            <a href="{{ route('event.index') }}"
                               class="inline-block bg-orange-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-orange-700 transition-all shadow-lg text-base transform hover:scale-105 active:scale-95">
                                Reset & Lihat Semua
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
    AOS.init({
        once: true,
        mirror: false,
        duration: 800,
        easing: 'ease-out-cubic',
    });

    // Highlight ongoing cards dynamically
    document.querySelectorAll('.event-card').forEach(card => {
        const badge = card.querySelector('.status-badge');
        if (badge && badge.textContent.includes('Sedang Berlangsung')) {
            card.classList.add('glow-green');
        }
    });

    // Smooth scroll to top when pagination clicked
    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

    // Z-index on hover for overlapping cards
    document.querySelectorAll('.event-card').forEach(card => {
        card.addEventListener('mouseenter', () => card.style.zIndex = '10');
        card.addEventListener('mouseleave', () => card.style.zIndex = '1');
    });
</script>
@endpush