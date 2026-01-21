<x-app-layout>

    <!-- Hero Section - Full Width -->
    <section class="hero-section">
        <div class="hero-container">

            <!-- Video Background -->
            <video
                id="hero-video"
                class="hero-video"
                autoplay
                muted
                loop
                playsinline
                preload="auto"
                poster="https://images.unsplash.com/photo-1580130718646-9f694209b207?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80"
            >
                <source src="{{ Storage::url('videos/candiborobudur.mp4') }}" type="video/mp4">
                <source src="{{ asset('videos/fallback.mp4') }}" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>

            <!-- Dark Overlay - Lebih Cerah -->
            <div class="hero-overlay"></div>

            <!-- Content -->
            <div class="hero-content">
                <h1 class="hero-title">
                    SMART TOURISM SYSTEM<br>
                    KAWASAN WISATA BOROBUDUR
                </h1>
            </div>

        </div>
    </section>

    <style>
        /* Reset any parent constraints */
        x-app-layout {
            display: block;
            margin: 0;
            padding: 0;
        }

        .hero-section {
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            margin-bottom: 0;
            padding: 0;
            overflow: hidden;
        }

        .hero-container {
            position: relative;
            height: 70vh;
            min-height: 500px;
            width: 100%;
            overflow: hidden;
        }

        .hero-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.25); /* Dikurangi dari 0.55 menjadi 0.25 */
        }

        .hero-content {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-align: center;
            color: white;
            padding: 1rem 1.5rem;
        }

        .hero-title {
            font-size: 2.25rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            margin-bottom: 1rem;
            filter: drop-shadow(0 25px 25px rgb(0 0 0 / 0.5));
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7); /* Tambahan shadow untuk tetap readable */
        }

        @media (min-width: 640px) {
            .hero-title {
                font-size: 3rem;
            }
            .hero-content {
                padding: 1.5rem;
            }
        }

        @media (min-width: 768px) {
            .hero-title {
                font-size: 3.75rem;
            }
        }

        @media (min-width: 1024px) {
            .hero-title {
                font-size: 4.5rem;
            }
            .hero-content {
                padding: 2rem;
            }
        }
    </style>

    <!-- Script fallback autoplay -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const video = document.getElementById('hero-video');
            if (video) {
                const playPromise = video.play();
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.warn('Autoplay diblok browser:', error);
                    });
                }

                document.body.addEventListener('click', function once() {
                    video.play().catch(() => {});
                    document.body.removeEventListener('click', once);
                }, { once: true });
            }
        });
    </script>
    @endpush

    <!-- Footer -->
    <footer class="bg-[#001f3f] text-white" style="margin: 0; padding-top: 0;">
        <div class="h-1.5 bg-blue-500 w-full"></div>
        <div class="py-6 px-6">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center space-x-4">
                    <img 
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0a/Logo_Kementerian_Pendidikan_dan_Kebudayaan_Indonesia.svg/512px-Logo_Kementerian_Pendidikan_dan_Kebudayaan_Indonesia.svg.png" 
                        alt="Logo Kemendikbud" 
                        class="h-12 w-12 object-contain"
                    />
                    <div>
                        <h3 class="text-lg md:text-xl font-bold tracking-wide">
                            Direktorat Penelitian dan Pengabdian kepada Masyarakat
                        </h3>
                        <p class="text-sm text-gray-300 mt-1">
                            2026 · Sistem Informasi Pariwisata
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </footer>

</x-app-layout>