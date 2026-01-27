@extends('frontend.layout.app')

@section('title', 'Berita Terbaru - STOURSYS')

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
    
    /* Bounce subtle */
    @keyframes bounceSubtle {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    /* Rotate badge */
    @keyframes rotateBadge {
        0% { transform: rotate(0deg) scale(1); }
        50% { transform: rotate(5deg) scale(1.05); }
        100% { transform: rotate(0deg) scale(1); }
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
    
    /* News card hover effects */
    .news-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    
    .news-card::before {
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
    
    .news-card:hover::before {
        opacity: 0.5;
    }
    
    .news-card:hover {
        transform: translateY(-12px) scale(1.02);
    }
    
    /* Image zoom with tilt */
    .image-container {
        perspective: 1000px;
    }
    
    .image-zoom {
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .news-card:hover .image-zoom {
        transform: scale(1.15) rotateZ(2deg);
    }
    
    /* Badge animation */
    .badge-animate {
        animation: rotateBadge 2s ease-in-out infinite;
    }
    
    /* Info icon pulse */
    .info-icon {
        transition: all 0.3s ease;
    }
    
    .info-icon:hover {
        transform: scale(1.2) rotate(10deg);
        color: #f97316;
    }
    
    /* Button hover effect */
    .read-more-btn {
        position: relative;
        overflow: hidden;
    }
    
    .read-more-btn::before {
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
    
    .read-more-btn:hover::before {
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
    
    /* Stagger animation delays */
    .stagger-1 { animation-delay: 0.1s; }
    .stagger-2 { animation-delay: 0.2s; }
    .stagger-3 { animation-delay: 0.3s; }
    
    /* Views counter animate */
    .counter-pop {
        display: inline-block;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .counter-pop:hover {
        transform: scale(1.15);
        color: #ea580c;
        font-weight: 700;
    }
    
    /* Pagination hover */
    .pagination-link {
        transition: all 0.3s ease;
    }
    
    .pagination-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
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
                        <span class="text-orange-600 text-sm font-semibold">Berita & Informasi</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-3 tracking-tight">
                        Berita Terbaru <span class="bg-gradient-to-r from-orange-500 via-orange-600 to-orange-500 bg-clip-text text-transparent animate-gradient">Kawasan Borobudur</span>
                    </h1>
                </div>
                <div class="flex-shrink-0 md:max-w-md" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                        Update terkini seputar wisata, budaya, dan perkembangan kawasan candi Borobudur
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Berita + Search (ukuran kecil) -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Search Bar - Ukuran ramping -->
            <div class="mb-8" data-aos="fade-up" data-aos-duration="800">
                <form method="GET" action="{{ route('berita.index') }}" class="max-w-md mx-auto">
                    <div class="relative flex items-center">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Cari berita atau topik..." 
                            class="search-input w-full px-5 py-3 pr-28 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 shadow-sm text-base transition-all hover:shadow-md"
                        >
                        <div class="absolute right-2 flex items-center gap-2">
                            <button type="submit" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-5 py-2.5 rounded-full font-medium hover:from-orange-600 hover:to-orange-700 transition-all shadow-md hover:shadow-lg flex items-center gap-1.5 text-sm transform hover:scale-105 active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('berita.index') }}" 
                                   class="text-gray-600 hover:text-orange-600 transition-all px-3 py-2.5 text-sm transform hover:scale-110">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

                @if(request('search'))
                    <p class="text-center mt-3 text-gray-600 text-sm" data-aos="fade-in" data-aos-delay="200">
                        Hasil untuk <strong class="text-orange-600">"{{ request('search') }}"</strong> 
                        ({{ $beritas->total() }} berita)
                    </p>
                @endif
            </div>

            <!-- Grid Berita -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($beritas as $index => $berita)
                    <div class="news-card group relative bg-white rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-200/50"
                         data-aos="fade-up" 
                         data-aos-duration="800" 
                         data-aos-delay="{{ $index * 100 }}">
                        <!-- Gambar -->
                        <div class="image-container relative h-64 overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800">
                            @if($berita->gambar_utama)
                                <img 
                                    src="{{ Storage::url($berita->gambar_utama) }}" 
                                    alt="{{ $berita->judul }}" 
                                    class="image-zoom w-full h-full object-cover"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0"></div>
                                <!-- Shimmer effect on hover -->
                                <div class="absolute inset-0 shimmer-effect opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-slate-800 via-blue-900 to-orange-900 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white/20 animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="absolute top-4 right-4 bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg badge-animate">
                                Terbaru
                            </div>
                        </div>

                        <!-- Konten -->
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-orange-600 transition-colors leading-tight line-clamp-2">
                                {{ $berita->judul }}
                            </h3>
                            
                            <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed text-sm">
                                {{ Str::limit($berita->excerpt ?? '', 110) }}
                            </p>

                            <!-- Info Berita -->
                            <div class="mb-6 space-y-2 text-sm text-gray-600">
                                <div class="flex items-center gap-2 group/info">
                                    <svg class="info-icon w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span class="group-hover/info:text-orange-600 transition-colors">{{ $berita->penulis ?? 'Admin' }}</span>
                                </div>
                                <div class="flex items-center gap-2 group/info">
                                    <svg class="info-icon w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="group-hover/info:text-orange-600 transition-colors">{{ $berita->tanggal_publikasi?->format('d F Y') ?? 'TBA' }}</span>
                                </div>
                                <div class="flex items-center gap-2 group/info">
                                    <svg class="info-icon w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span class="counter-pop">{{ $berita->views ?? 0 }}</span> <span class="group-hover/info:text-orange-600 transition-colors">kali dilihat</span>
                                </div>
                            </div>

                            <a href="{{ route('berita.show', $berita->id) }}"
                               class="read-more-btn inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 group/btn text-sm relative overflow-hidden transform active:scale-95">
                                <span class="relative z-10">Baca Selengkapnya</span>
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
                                <span class="text-5xl">📰</span>
                            </div>
                            
                            <h3 class="text-3xl font-bold text-slate-900 mb-3">
                                @if(request('search'))
                                    Tidak menemukan berita untuk "{{ request('search') }}"
                                @else
                                    Belum Ada Berita
                                @endif
                            </h3>
                            
                            <p class="text-gray-600 text-lg mb-6">
                                @if(request('search'))
                                    Coba kata kunci lain atau reset pencarian.
                                @else
                                    Berita terbaru akan segera hadir. Nantikan update dari kami!
                                @endif
                            </p>

                            @if(request('search'))
                                <a href="{{ route('berita.index') }}" 
                                   class="inline-block bg-orange-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-orange-700 transition-all shadow-lg transform hover:scale-105 active:scale-95">
                                    Lihat Semua Berita
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($beritas->hasPages())
                <div class="mt-12 flex justify-center" data-aos="fade-up" data-aos-duration="800">
                    {{ $beritas->links('pagination::tailwind') }}
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
    
    // Counter animation on scroll
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.textContent);
                const duration = 1000;
                const steps = 30;
                const increment = target / steps;
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }, duration / steps);
                
                observer.unobserve(counter);
            }
        });
    }, observerOptions);
    
    // Observe all view counters
    document.querySelectorAll('.counter-pop').forEach(counter => {
        observer.observe(counter);
    });
    
    // Smooth scroll for pagination
    document.querySelectorAll('.pagination-link').forEach(link => {
        link.addEventListener('click', function(e) {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
    
    // Add hover sound effect (optional - can be removed)
    const cards = document.querySelectorAll('.news-card');
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