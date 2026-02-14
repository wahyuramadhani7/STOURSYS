@extends('frontend.layout.app')

@section('title', 'Apa itu STourSys - STOURSYS')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    /* Semua animasi dan efek dari halaman event sebelumnya */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }
    
    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 20px rgba(249, 115, 22, 0.4); }
        50% { box-shadow: 0 0 30px rgba(249, 115, 22, 0.6); }
    }
    
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }
    
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    @keyframes badgePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    @keyframes bounceSubtle {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    .animate-float { animation: float 3s ease-in-out infinite; }
    .animate-pulse-glow { animation: pulseGlow 2s ease-in-out infinite; }
    .shimmer-effect {
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        background-size: 1000px 100%;
        animation: shimmer 2s infinite;
    }
    .animate-gradient {
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }
    .badge-pulse { animation: badgePulse 2s ease-in-out infinite; }
    
    /* Efek hover mirip event card */
    .feature-card, .hero-container {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .feature-card::before, .hero-container::before {
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
    
    .feature-card:hover::before, .hero-container:hover::before {
        opacity: 0.5;
    }
    
    .feature-card:hover, .hero-container:hover {
        transform: translateY(-12px) scale(1.02);
    }
    
    .video-zoom {
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .hero-container:hover .video-zoom {
        transform: scale(1.15) rotateZ(2deg);
    }
    
    .info-item {
        transition: all 0.3s ease;
    }
    
    .info-item:hover {
        color: #f97316;
        transform: translateX(3px);
    }
    
    .cta-button {
        position: relative;
        overflow: hidden;
    }
    
    .cta-button::before {
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
    
    .cta-button:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .empty-icon {
        animation: bounceSubtle 2s ease-in-out infinite;
    }

    /* Tambahan untuk video hero agar responsive */
    .video-wrapper {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
        height: 0;
        overflow: hidden;
        border-radius: 1rem;
        background: #000;
    }

    .video-wrapper video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .video-credit {
        text-align: center;
        font-size: 0.95rem;
        color: #6b7280;
        margin-top: 1rem;
    }

    .video-credit a {
        color: #f97316;
        font-weight: 600;
        text-decoration: underline;
        transition: color 0.3s;
    }

    .video-credit a:hover {
        color: #ea580c;
    }
</style>
@endpush

@section('content')
    <!-- Header Section -->
    <section class="py-16 bg-gradient-to-r from-orange-50 via-white to-blue-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="flex-1" data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-block mb-3 px-4 py-2 bg-orange-100 rounded-full border border-orange-200 animate-pulse-glow">
                        <span class="text-orange-600 text-sm font-semibold">Tentang Kami</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-3 tracking-tight">
                        Apa itu <span class="bg-gradient-to-r from-orange-500 via-orange-600 to-orange-500 bg-clip-text text-transparent animate-gradient">STourSys</span>?
                    </h1>
                </div>
                <div class="flex-shrink-0 md:max-w-md" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                        Smart Tourism System Kawasan Candi Borobudur
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Hero Video - Dari Storage Lokal -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="hero-container rounded-2xl overflow-hidden shadow-2xl transform hover:scale-[1.02] transition-all duration-500 border border-gray-200/50"
                 data-aos="zoom-in" data-aos-duration="1000">
                <div class="relative">
                    <div class="video-wrapper">
                        <video 
                            class="video-zoom"
                            autoplay 
                            loop 
                            muted 
                            playsinline 
                            preload="metadata"
                            poster="{{ asset('storage/images/borobudur1.webp') }}"
                        >
                            <source src="{{ asset('storage/videos/borobudur2.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-black/0 shimmer-effect opacity-0 hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent py-6 px-6 md:px-10 text-white text-center text-lg md:text-2xl font-semibold pointer-events-none">
                        Candi Borobudur – Warisan Dunia UNESCO
                    </div>
                </div>

                <!-- Credit Sumber Video -->
                <div class="video-credit">
                    Video aerial indah Candi Borobudur oleh <a href="https://youtu.be/6DiEVUSrRqE" target="_blank" rel="noopener noreferrer">Studio Sunday</a> (YouTube). Digunakan dengan izin non-komersial + credit.
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg md:prose-xl prose-blue max-w-none mx-auto text-gray-800 leading-relaxed">
                <p class="mb-6 text-justify" data-aos="fade-up" data-aos-duration="800">
                    <strong class="text-blue-800">STourSys</strong> (Smart Tourism System) adalah sistem informasi pariwisata yang dikembangkan khusus untuk mendukung pengelolaan, promosi, dan pengalaman wisata di 
                    <strong>kawasan Candi Borobudur dan wilayah sekitarnya</strong>.
                </p>

                <p class="mb-6 text-justify" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    Sistem ini menyediakan informasi lengkap, akurat, dan terkini mengenai berbagai destinasi wisata di sekitar Candi Borobudur, termasuk:
                </p>

                <ul class="list-disc pl-6 md:pl-8 mb-8 space-y-3 text-gray-700" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <li>Candi Borobudur beserta relief, stupa, arsitektur, dan nilai sejarahnya</li>
                    <li>Candi Mendut dan Candi Pawon sebagai bagian dari rangkaian candi Buddha</li>
                    <li>Desa wisata budaya autentik (Candirejo, Wanurejo, Karangrejo, Borobudur Village, dll)</li>
                    <li>Objek wisata alam & instagramable: Punthuk Setumbu, Bukit Barede, Gereja Ayam, spot sunrise & sunset</li>
                    <li>Destinasi pendukung di Kabupaten Magelang dan sekitarnya yang terhubung dengan Borobudur</li>
                </ul>

                <p class="mb-6 text-justify font-medium" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    STourSys bertujuan untuk:
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                    <div class="feature-card bg-white rounded-2xl p-6 border border-gray-200/50 shadow-sm hover:shadow-xl transition-all duration-500 group"
                         data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                        <div class="flex items-start gap-4">
                            <span class="text-green-600 text-4xl flex-shrink-0">✓</span>
                            <p class="text-gray-700 text-lg">
                                Membantu wisatawan merencanakan kunjungan dengan informasi rute, jam buka, tiket, fasilitas, dan aksesibilitas
                            </p>
                        </div>
                    </div>

                    <div class="feature-card bg-white rounded-2xl p-6 border border-gray-200/50 shadow-sm hover:shadow-xl transition-all duration-500 group"
                         data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
                        <div class="flex items-start gap-4">
                            <span class="text-green-600 text-4xl flex-shrink-0">✓</span>
                            <p class="text-gray-700 text-lg">
                                Meningkatkan pengalaman wisata melalui panduan digital dan informasi real-time
                            </p>
                        </div>
                    </div>

                    <div class="feature-card bg-white rounded-2xl p-6 border border-gray-200/50 shadow-sm hover:shadow-xl transition-all duration-500 group"
                         data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                        <div class="flex items-start gap-4">
                            <span class="text-green-600 text-4xl flex-shrink-0">✓</span>
                            <p class="text-gray-700 text-lg">
                                Mendukung pelaku usaha lokal (homestay, kuliner, souvenir, pemandu wisata)
                            </p>
                        </div>
                    </div>

                    <div class="feature-card bg-white rounded-2xl p-6 border border-gray-200/50 shadow-sm hover:shadow-xl transition-all duration-500 group"
                         data-aos="fade-up" data-aos-duration="800" data-aos-delay="700">
                        <div class="flex items-start gap-4">
                            <span class="text-green-600 text-4xl flex-shrink-0">✓</span>
                            <p class="text-gray-700 text-lg">
                                Melestarikan warisan budaya, lingkungan, dan keberlanjutan kawasan Candi Borobudur
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center mt-16" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">
                <p class="text-xl md:text-2xl text-gray-700 mb-8 font-light">
                    Jelajahi keindahan dan kekayaan budaya kawasan Candi Borobudur melalui STourSys!
                </p>
                <a href="{{ route('destinasi.index') }}" 
                   class="cta-button inline-flex items-center bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-4 px-10 md:px-12 rounded-full text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 active:scale-95 relative overflow-hidden">
                    <span class="relative z-10">Lihat Daftar Destinasi</span>
                    <svg class="relative z-10 w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
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
</script>
@endpush