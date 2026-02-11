<x-app-layout>

    <!-- Hero Section - Full Width & Responsive -->
    <section class="hero-section">
        <div class="hero-container">

            <!-- Video 1 -->
            <video
                id="hero-video-1"
                class="hero-video active"
                muted
                playsinline
                preload="auto"
                poster="https://images.unsplash.com/photo-1580130718646-9f694209b207?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80"
            >
                <source src="{{ Storage::url('videos/borobudur2.mp4') }}" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>

            <!-- Video 2 -->
            <video
                id="hero-video-2"
                class="hero-video"
                muted
                playsinline
                preload="auto"
                poster="https://images.unsplash.com/photo-1580130718646-9f694209b207?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80"
            >
                <source src="{{ Storage::url('videos/candiborobudur.mp4') }}" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>

            <!-- Dark Overlay -->
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
        /* Reset untuk menghilangkan semua gap */
        x-app-layout {
            display: block;
            margin: 0;
            padding: 0;
        }
        
        /* Hero Section - Full Width Responsive */
        .hero-section {
            width: 100%;
            position: relative;
            margin: 0;
            padding: 0;
            display: block;
            line-height: 0;
            overflow: hidden;
        }

        .hero-container {
            position: relative;
            width: 100%;
            height: calc(100vh - 180px); /* Dikurangi tinggi header+nav+footer */
            min-height: 500px;
            display: block;
            line-height: 0;
            overflow: hidden;
        }
        
        /* Responsive height adjustments */
        @media (max-width: 640px) {
            .hero-container {
                height: calc(100vh - 200px);
                min-height: 400px;
            }
        }
        
        @media (min-width: 641px) and (max-width: 1023px) {
            .hero-container {
                height: calc(100vh - 180px);
                min-height: 450px;
            }
        }
        
        @media (min-width: 1024px) {
            .hero-container {
                height: calc(100vh - 170px);
                min-height: 500px;
            }
        }

        /* Video styling dengan object-fit untuk semua device */
        .hero-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            opacity: 0;
            transition: opacity 1.2s ease-in-out;
            z-index: 1;
            display: block;
            vertical-align: bottom;
        }

        .hero-video.active {
            opacity: 1;
            z-index: 2;
        }

        /* Overlay dengan opacity yang pas untuk semua device */
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                to bottom,
                rgba(0, 0, 0, 0.2) 0%,
                rgba(0, 0, 0, 0.3) 50%,
                rgba(0, 0, 0, 0.4) 100%
            );
            z-index: 3;
            pointer-events: none;
        }

        /* Content positioning - responsive */
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
            padding: 1rem;
        }

        /* Title styling - fully responsive */
        .hero-title {
            font-weight: 800;
            letter-spacing: -0.025em;
            line-height: 1.2;
            margin: 0;
            padding: 0 1rem;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.5));
            text-shadow: 
                2px 2px 4px rgba(0, 0, 0, 0.8),
                0 0 10px rgba(0, 0, 0, 0.5);
            word-wrap: break-word;
            max-width: 100%;
        }

        /* Mobile First - Small devices (portrait phones) */
        @media (max-width: 374px) {
            .hero-title {
                font-size: 1.5rem; /* 24px */
            }
            .hero-content {
                padding: 0.75rem;
            }
        }

        /* Small devices (landscape phones, 375px and up) */
        @media (min-width: 375px) and (max-width: 639px) {
            .hero-title {
                font-size: 1.75rem; /* 28px */
            }
        }

        /* Medium devices (tablets, 640px and up) */
        @media (min-width: 640px) and (max-width: 767px) {
            .hero-title {
                font-size: 2.25rem; /* 36px */
            }
            .hero-content {
                padding: 1.25rem;
            }
        }

        /* Large tablets (768px and up) */
        @media (min-width: 768px) and (max-width: 1023px) {
            .hero-title {
                font-size: 2.75rem; /* 44px */
            }
            .hero-content {
                padding: 1.5rem;
            }
        }

        /* Desktop (1024px and up) */
        @media (min-width: 1024px) and (max-width: 1279px) {
            .hero-title {
                font-size: 3.25rem; /* 52px */
            }
            .hero-content {
                padding: 2rem;
            }
        }

        /* Large desktop (1280px and up) */
        @media (min-width: 1280px) and (max-width: 1535px) {
            .hero-title {
                font-size: 3.75rem; /* 60px */
            }
        }

        /* Extra large desktop (1536px and up) */
        @media (min-width: 1536px) {
            .hero-title {
                font-size: 4.5rem; /* 72px */
            }
        }

        /* Landscape orientation adjustments */
        @media (max-height: 500px) and (orientation: landscape) {
            .hero-container {
                min-height: 300px;
                height: 50vh;
            }
            .hero-title {
                font-size: 1.5rem !important;
            }
            .hero-content {
                padding: 0.5rem;
            }
        }
    </style>

    <!-- Scripts -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const video1 = document.getElementById('hero-video-1');
            const video2 = document.getElementById('hero-video-2');

            if (!video1 || !video2) {
                console.error('Video elements not found');
                return;
            }

            let currentVideo = video1;
            let nextVideo = video2;
            let isPlaying = false;

            // Function to play video safely
            function playVideo(video) {
                const playPromise = video.play();
                if (playPromise !== undefined) {
                    playPromise
                        .then(() => {
                            isPlaying = true;
                            console.log('Video playing successfully');
                        })
                        .catch(err => {
                            console.warn('Autoplay prevented:', err);
                            isPlaying = false;
                            // Show a play button or message to user if needed
                        });
                }
            }

            // Start first video
            function startFirstVideo() {
                currentVideo.classList.add('active');
                playVideo(currentVideo);
            }

            // Setup video switching
            function setupVideoSwitch() {
                currentVideo.addEventListener('ended', function handleEnded() {
                    // Fade out current
                    currentVideo.classList.remove('active');

                    // Fade in next
                    nextVideo.classList.add('active');
                    playVideo(nextVideo);

                    // Swap references
                    [currentVideo, nextVideo] = [nextVideo, currentVideo];
                });
            }

            // Fallback: user interaction to start video
            let interactionListener = function(e) {
                if (!isPlaying && currentVideo.paused) {
                    playVideo(currentVideo);
                }
                // Remove listener after first interaction
                document.body.removeEventListener('click', interactionListener);
                document.body.removeEventListener('touchstart', interactionListener);
            };

            document.body.addEventListener('click', interactionListener, { once: true });
            document.body.addEventListener('touchstart', interactionListener, { once: true });

            // Initialize
            startFirstVideo();
            setupVideoSwitch();

            // Dynamic height adjustment - Fill available space
            function adjustHeroHeight() {
                const hero = document.querySelector('.hero-container');
                const header = document.querySelector('header');
                const nav = document.querySelector('nav');
                const footer = document.querySelector('footer');
                
                if (hero && header && nav && footer) {
                    const vh = window.innerHeight;
                    const headerHeight = header.offsetHeight;
                    const navHeight = nav.offsetHeight;
                    const footerHeight = footer.offsetHeight;
                    
                    // Hitung tinggi yang tersedia
                    const availableHeight = vh - headerHeight - navHeight - footerHeight;
                    const minHeight = window.innerWidth < 640 ? 400 : 
                                     window.innerWidth < 1024 ? 450 : 500;
                    
                    // Set height to fill available space
                    const finalHeight = Math.max(minHeight, availableHeight);
                    hero.style.height = finalHeight + 'px';
                }
            }

            // Adjust on load and resize
            adjustHeroHeight();
            
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(adjustHeroHeight, 150);
            });

            // Handle orientation change
            window.addEventListener('orientationchange', function() {
                setTimeout(adjustHeroHeight, 200);
            });

            // Pause video when tab is not visible (performance)
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    if (!currentVideo.paused) {
                        currentVideo.pause();
                    }
                } else {
                    if (currentVideo.paused && isPlaying) {
                        playVideo(currentVideo);
                    }
                }
            });

            // Preload next video
            if (nextVideo.readyState < 2) {
                nextVideo.load();
            }
        });
    </script>
    @endpush

</x-app-layout>