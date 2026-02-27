@extends('frontend.layout.app')

@section('title', 'Apa itu STourSys - STOURSYS')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    .language-card {
        transition: all 0.3s ease;
        background: rgba(249, 115, 22, 0.03);
        border-radius: 0.875rem;
    }
    .language-card:hover {
        background: rgba(249, 115, 22, 0.12);
        transform: translateY(-3px);
        border-color: #fb923c;
    }

    /* Video hero diperkecil lagi: max 720px, aspect lebih compact */
    .hero-container {
        max-width: 720px;               /* ← diperkecil dari 800px */
        margin-left: auto;
        margin-right: auto;
    }

    .video-wrapper {
        position: relative;
        padding-top: 48%;               /* ← lebih pendek lagi dari 50% */
        overflow: hidden;
        border-radius: 0.875rem;
    }

    .video-zoom {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s ease;
    }

    .hero-container:hover .video-zoom {
        transform: scale(1.025);
    }

    .video-credit {
        font-size: 0.75rem;
        color: #6b7280;
        text-align: center;
        margin-top: 0.625rem;
    }

    /* Grid bahasa tetap compact */
    .language-grid {
        grid-template-columns: repeat(auto-fit, minmax(95px, 1fr));
        gap: 0.75rem;
    }

    @media (max-width: 640px) {
        .language-grid {
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 0.5rem;
        }
        .language-card {
            padding: 0.75rem 0.4rem;
        }
        .language-card .text-3xl {
            font-size: 2rem;
        }
    }

    /* Padding section hero lebih ringkas */
    .hero-section {
        padding-top: 1.5rem !important;
        padding-bottom: 2rem !important;
    }

    @media (min-width: 768px) {
        .hero-section {
            padding-top: 2rem !important;
            padding-bottom: 2.5rem !important;
        }
    }
</style>
@endpush

@section('content')
    <!-- Header Section – sedikit lebih ringkas -->
    <section class="py-12 bg-gradient-to-r from-orange-50 via-white to-blue-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                <div class="flex-1" data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-block mb-2.5 px-3.5 py-1.5 bg-orange-100 rounded-full border border-orange-200 animate-pulse-glow">
                        <span class="text-orange-600 text-xs font-semibold uppercase tracking-wide">Tentang Kami</span>
                    </div>
                    <h1 class="text-2.5xl md:text-4xl lg:text-5xl font-black text-slate-900 mb-2.5 tracking-tight">
                        Apa itu <span class="bg-gradient-to-r from-orange-500 via-orange-600 to-orange-500 bg-clip-text text-transparent animate-gradient">STourSys</span>?
                    </h1>
                </div>
                <div class="flex-shrink-0 md:max-w-md" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <p class="text-gray-600 text-base leading-relaxed">
                        Smart Tourism System Kawasan Candi Borobudur
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Hero Video – ukuran lebih kecil -->
    <section class="hero-section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="hero-container rounded-xl overflow-hidden shadow-lg transform hover:scale-[1.01] transition-all duration-400 border border-gray-200/30"
                 data-aos="zoom-in" data-aos-duration="900">
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
                            Browser Anda tidak mendukung tag video.
                        </video>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/20 to-transparent opacity-70 hover:opacity-85 transition-opacity duration-500 pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent py-3.5 px-4 md:px-6 text-white text-center text-xs sm:text-sm md:text-base font-medium pointer-events-none">
                        Candi Borobudur – Warisan Dunia UNESCO
                    </div>
                </div>

                <div class="video-credit mt-2">
                    Video aerial oleh <a href="https://youtu.be/6DiEVUSrRqE" target="_blank" rel="noopener noreferrer">Studio Sunday</a> (YouTube)
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content – spacing sedikit lebih rapat -->
    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-base md:prose-lg prose-blue max-w-none mx-auto text-gray-800 leading-relaxed">
                <p class="mb-4 text-justify" data-aos="fade-up" data-aos-duration="800">
                    <strong class="text-blue-800">STourSys</strong> (Smart Tourism System) adalah sistem informasi pariwisata cerdas untuk mendukung pengelolaan, promosi, dan pengalaman wisata di kawasan <strong>Candi Borobudur dan sekitarnya</strong>.
                </p>

                <p class="mb-4 text-justify" data-aos="fade-up" data-aos-duration="800" data-aos-delay="80">
                    Menyediakan informasi lengkap & terkini tentang destinasi wisata di sekitar Borobudur, meliputi:
                </p>

                <ul class="list-disc pl-5 md:pl-7 mb-6 space-y-2 text-gray-700" data-aos="fade-up" data-aos-duration="800" data-aos-delay="160">
                    <li>Candi Borobudur (relief, stupa, sejarah)</li>
                    <li>Candi Mendut & Candi Pawon</li>
                    <li>Desa wisata budaya (Candirejo, Wanurejo, Karangrejo, dll.)</li>
                    <li>Spot alam & instagramable (Punthuk Setumbu, Bukit Barede, Gereja Ayam, sunrise/sunset)</li>
                    <li>Destinasi pendukung di Magelang dan sekitarnya</li>
                </ul>

                <p class="mb-4 text-justify font-medium" data-aos="fade-up" data-aos-duration="800" data-aos-delay="240">
                    Kawasan Borobudur sudah memiliki panduan multibahasa resmi (pemandu & audio guide) dalam bahasa Indonesia, Inggris, Mandarin, Korea, Jepang, Belanda, Prancis, Spanyol, Jerman.
                </p>

                <p class="mb-4 text-justify" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    STourSys melengkapi dengan panduan digital interaktif, real-time, mudah diakses via web/aplikasi — lengkap dengan penjelasan relief, etika kunjungan, dan tips praktis.
                </p>

                <div class="language-grid grid mb-7" data-aos="fade-up" data-aos-duration="800" data-aos-delay="360">
                    <div class="language-card p-2.5 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-3xl mb-1">🇮🇩</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600 text-xs">Indonesia</p>
                    </div>
                    <div class="language-card p-2.5 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-3xl mb-1">🇬🇧</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600 text-xs">English</p>
                    </div>
                    <div class="language-card p-2.5 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-3xl mb-1">🇨🇳</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600 text-xs">中文</p>
                    </div>
                    <div class="language-card p-2.5 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-3xl mb-1">🇰🇷</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600 text-xs">한국어</p>
                    </div>
                    <div class="language-card p-2.5 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-3xl mb-1">🇯🇵</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600 text-xs">日本語</p>
                    </div>
                    <div class="language-card p-2.5 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-3xl mb-1">🇫🇷</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600 text-xs">Français</p>
                    </div>
                    <div class="language-card p-2.5 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-3xl mb-1">🇩🇪</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600 text-xs">Deutsch</p>
                    </div>
                    <div class="language-card p-2.5 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-3xl mb-1">🇪🇸</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600 text-xs">Español</p>
                    </div>
                    <div class="language-card p-2.5 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group col-span-2 sm:col-span-1">
                        <div class="text-3xl mb-1">🌐</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600 text-xs">Lainnya</p>
                    </div>
                </div>

                <p class="mb-6 text-justify italic text-gray-600 text-sm" data-aos="fade-up" data-aos-duration="800" data-aos-delay="420">
                    Multibahasa resmi + digital STourSys memudahkan wisatawan internasional menikmati Borobudur tanpa kendala bahasa.
                </p>

                <p class="mb-4 text-justify font-medium" data-aos="fade-up" data-aos-duration="800" data-aos-delay="480">
                    Tujuan utama STourSys:
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
                    <div class="feature-card bg-white rounded-lg p-4 border border-gray-200/50 shadow-sm hover:shadow-md transition-all duration-300 group"
                         data-aos="fade-up" data-aos-duration="800" data-aos-delay="540">
                        <div class="flex items-start gap-3">
                            <span class="text-green-600 text-2xl flex-shrink-0">✓</span>
                            <p class="text-gray-700 text-sm md:text-base">
                                Membantu perencanaan: rute, jam buka, tiket, fasilitas
                            </p>
                        </div>
                    </div>
                    <div class="feature-card bg-white rounded-lg p-4 border border-gray-200/50 shadow-sm hover:shadow-md transition-all duration-300 group"
                         data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                        <div class="flex items-start gap-3">
                            <span class="text-green-600 text-2xl flex-shrink-0">✓</span>
                            <p class="text-gray-700 text-sm md:text-base">
                                Pengalaman lebih baik dengan panduan digital real-time
                            </p>
                        </div>
                    </div>
                    <div class="feature-card bg-white rounded-lg p-4 border border-gray-200/50 shadow-sm hover:shadow-md transition-all duration-300 group"
                         data-aos="fade-up" data-aos-duration="800" data-aos-delay="660">
                        <div class="flex items-start gap-3">
                            <span class="text-green-600 text-2xl flex-shrink-0">✓</span>
                            <p class="text-gray-700 text-sm md:text-base">
                                Dukung UMKM lokal (homestay, kuliner, souvenir, guide)
                            </p>
                        </div>
                    </div>
                    <div class="feature-card bg-white rounded-lg p-4 border border-gray-200/50 shadow-sm hover:shadow-md transition-all duration-300 group"
                         data-aos="fade-up" data-aos-duration="800" data-aos-delay="720">
                        <div class="flex items-start gap-3">
                            <span class="text-green-600 text-2xl flex-shrink-0">✓</span>
                            <p class="text-gray-700 text-sm md:text-base">
                                Jaga kelestarian budaya, alam & keberlanjutan
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA lebih compact -->
            <div class="text-center mt-10" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">
                <p class="text-base md:text-lg text-gray-700 mb-5 font-light">
                    Jelajahi Borobudur bersama STourSys sekarang!
                </p>
                <a href="{{ route('destinasi.index') }}" 
                   class="inline-flex items-center bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold py-3 px-7 md:px-9 rounded-full text-sm md:text-base shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5"
                   aria-label="Lihat daftar destinasi">
                    <span>Lihat Destinasi</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
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