@extends('frontend.layout.app')

@section('title', 'Apa itu STourSys - STOURSYS')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    /* (Style tetap sama seperti sebelumnya, saya tidak ulang agar ringkas. Tambahkan saja class language-card jika belum ada) */
    .language-card {
        transition: all 0.3s ease;
        background: rgba(249, 115, 22, 0.03);
    }
    .language-card:hover {
        background: rgba(249, 115, 22, 0.12);
        transform: translateY(-4px);
        border-color: #fb923c;
    }
</style>
@endpush

@section('content')
    <!-- Header Section (tetap sama) -->
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

    <!-- Hero Video (tetap sama) -->
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
                            Browser Anda tidak mendukung tag video.
                        </video>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-black/0 shimmer-effect opacity-0 hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent py-6 px-6 md:px-10 text-white text-center text-lg md:text-2xl font-semibold pointer-events-none">
                        Candi Borobudur – Warisan Dunia UNESCO
                    </div>
                </div>

                <div class="video-credit mt-4">
                    Video aerial indah Candi Borobudur oleh <a href="https://youtu.be/6DiEVUSrRqE" target="_blank" rel="noopener noreferrer">Studio Sunday</a> (YouTube). Digunakan dengan izin non-komersial + credit.
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content – Bagian ini yang diupdate -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg md:prose-xl prose-blue max-w-none mx-auto text-gray-800 leading-relaxed">
                <p class="mb-6 text-justify" data-aos="fade-up" data-aos-duration="800">
                    <strong class="text-blue-800">STourSys</strong> (Smart Tourism System) adalah sistem informasi pariwisata cerdas yang dikembangkan khusus untuk mendukung pengelolaan, promosi, dan pengalaman wisata di 
                    <strong>kawasan Candi Borobudur beserta wilayah sekitarnya</strong>.
                </p>

                <p class="mb-6 text-justify" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    Sistem ini menyediakan informasi lengkap, akurat, dan terkini mengenai berbagai destinasi wisata di sekitar Candi Borobudur, termasuk:
                </p>

                <ul class="list-disc pl-6 md:pl-8 mb-8 space-y-3 text-gray-700" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <li>Candi Borobudur beserta relief, stupa, arsitektur, dan nilai sejarahnya</li>
                    <li>Candi Mendut dan Candi Pawon sebagai bagian dari rangkaian candi Buddha</li>
                    <li>Desa wisata budaya autentik (Candirejo, Wanurejo, Karangrejo, Borobudur Village, dll.)</li>
                    <li>Objek wisata alam & instagramable: Punthuk Setumbu, Bukit Barede, Gereja Ayam, spot sunrise & sunset</li>
                    <li>Destinasi pendukung di Kabupaten Magelang dan sekitarnya yang terhubung dengan Borobudur</li>
                </ul>

                <p class="mb-6 text-justify font-medium" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    Di kawasan wisata Candi Borobudur sendiri, sudah tersedia <strong>panduan/guide lengkap multibahasa</strong> baik berupa pemandu wisata berlisensi maupun audio guide resmi, untuk mendukung wisatawan internasional.
                </p>

                <p class="mb-6 text-justify" data-aos="fade-up" data-aos-duration="800" data-aos-delay="350">
                    Panduan di lokasi mencakup bahasa Indonesia, Inggris, Mandarin, Korea, Jepang, Belanda, Prancis, Spanyol, dan Jerman (sesuai layanan resmi PT Taman Wisata Candi). STourSys melengkapi fasilitas ini dengan <strong>panduan digital terintegrasi</strong> yang lebih interaktif, real-time, dan mudah diakses via website atau aplikasi — termasuk penjelasan mendalam tentang sejarah, relief, etika kunjungan, serta tips praktis.
                </p>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-10" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="language-card rounded-xl p-4 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-4xl mb-2">🇮🇩</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600">Indonesia</p>
                    </div>
                    <div class="language-card rounded-xl p-4 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-4xl mb-2">🇬🇧</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600">English</p>
                    </div>
                    <div class="language-card rounded-xl p-4 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-4xl mb-2">🇨🇳</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600">中文 (Mandarin)</p>
                    </div>
                    <div class="language-card rounded-xl p-4 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-4xl mb-2">🇰🇷</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600">한국어 (Korean)</p>
                    </div>
                    <div class="language-card rounded-xl p-4 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-4xl mb-2">🇯🇵</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600">日本語 (Japanese)</p>
                    </div>
                    <div class="language-card rounded-xl p-4 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-4xl mb-2">🇫🇷</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600">Français</p>
                    </div>
                    <div class="language-card rounded-xl p-4 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-4xl mb-2">🇩🇪</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600">Deutsch</p>
                    </div>
                    <div class="language-card rounded-xl p-4 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group">
                        <div class="text-4xl mb-2">🇪🇸</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600">Español</p>
                    </div>
                    <div class="language-card rounded-xl p-4 text-center border border-orange-200 hover:shadow-md transition-all duration-300 group col-span-2 sm:col-span-1">
                        <div class="text-4xl mb-2">🌐</div>
                        <p class="font-medium text-gray-800 group-hover:text-orange-600">Dan bahasa lainnya (resmi & digital)</p>
                    </div>
                </div>

                <p class="mb-8 text-justify italic text-gray-600" data-aos="fade-up" data-aos-duration="800" data-aos-delay="450">
                    Dengan dukungan multibahasa ini — baik dari fasilitas resmi kawasan maupun STourSys — wisatawan dari berbagai negara dapat menikmati dan memahami kekayaan budaya Candi Borobudur tanpa hambatan bahasa.
                </p>

                <p class="mb-6 text-justify font-medium" data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
                    STourSys bertujuan untuk:
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                    <!-- Feature cards tetap sama seperti sebelumnya -->
                    <div class="feature-card bg-white rounded-2xl p-6 border border-gray-200/50 shadow-sm hover:shadow-xl transition-all duration-500 group"
                         data-aos="fade-up" data-aos-duration="800" data-aos-delay="550">
                        <div class="flex items-start gap-4">
                            <span class="text-green-600 text-4xl flex-shrink-0">✓</span>
                            <p class="text-gray-700 text-lg">
                                Membantu wisatawan merencanakan kunjungan dengan informasi rute, jam buka, tiket, fasilitas, dan aksesibilitas
                            </p>
                        </div>
                    </div>

                    <div class="feature-card bg-white rounded-2xl p-6 border border-gray-200/50 shadow-sm hover:shadow-xl transition-all duration-500 group"
                         data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                        <div class="flex items-start gap-4">
                            <span class="text-green-600 text-4xl flex-shrink-0">✓</span>
                            <p class="text-gray-700 text-lg">
                                Meningkatkan pengalaman wisata melalui panduan digital dan informasi real-time
                            </p>
                        </div>
                    </div>

                    <div class="feature-card bg-white rounded-2xl p-6 border border-gray-200/50 shadow-sm hover:shadow-xl transition-all duration-500 group"
                         data-aos="fade-up" data-aos-duration="800" data-aos-delay="650">
                        <div class="flex items-start gap-4">
                            <span class="text-green-600 text-4xl flex-shrink-0">✓</span>
                            <p class="text-gray-700 text-lg">
                                Memberdayakan pelaku usaha lokal (homestay, kuliner, souvenir, pemandu wisata)
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

            <!-- Call to Action (tetap sama) -->
            <div class="text-center mt-16" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">
                <p class="text-xl md:text-2xl text-gray-700 mb-8 font-light">
                    Jelajahi keindahan dan kekayaan budaya kawasan Candi Borobudur melalui STourSys sekarang!
                </p>
                <a href="{{ route('destinasi.index') }}" 
                   class="cta-button inline-flex items-center bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-4 px-10 md:px-12 rounded-full text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 active:scale-95 relative overflow-hidden"
                   aria-label="Lihat daftar destinasi wisata di STourSys">
                    <span class="relative z-10">Lihat Daftar Destinasi</span>
                    <svg class="relative z-10 w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
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