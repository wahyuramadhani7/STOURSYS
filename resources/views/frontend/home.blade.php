<x-app-layout>

    <!-- Hero Section - Full Width & Responsive -->
    <section class="hero-section">
        <div class="hero-container" id="heroContainer">

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

            <!-- Credit sumber video - pojok kanan bawah -->
            <div class="video-credit">
                Sumber: <a href="https://youtu.be/6DiEVUSrRqE" target="_blank" rel="noopener noreferrer">Studio Sunday</a> – Aerial Drone Videography Borobudur
            </div>

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
        /* x-app-layout harus mengisi penuh ruang <main> */
        x-app-layout {
            display: block;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        /* Hero section mengisi 100% tinggi <main> */
        .hero-section {
            width: 100%;
            height: 100%;
            position: relative;
            margin: 0;
            padding: 0;
            display: block;
            line-height: 0;
            overflow: hidden;
        }

        /* Hero container sama tinggi dengan section */
        .hero-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: block;
            line-height: 0;
            overflow: hidden;
        }

        /* Video styling */
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

        /* Overlay */
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

        /* Credit text - pojok kanan bawah */
        .video-credit {
            position: absolute;
            bottom: 1.25rem;
            right: 1.5rem;
            z-index: 5;
            color: rgba(255, 255, 255, 0.80);
            font-size: 0.875rem;
            font-weight: 400;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.9);
            pointer-events: auto;
            max-width: 80%;
            line-height: 1.4;
            letter-spacing: 0.3px;
        }

        .video-credit a {
            color: rgba(255, 255, 255, 0.95);
            text-decoration: underline;
            text-underline-offset: 2px;
            transition: color 0.3s ease;
        }

        .video-credit a:hover {
            color: white;
        }

        @media (max-width: 640px) {
            .video-credit {
                font-size: 0.75rem;
                bottom: 1rem;
                right: 1rem;
                max-width: 70%;
            }
        }

        /* Content positioning */
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

        /* Title - responsive dengan clamp agar tidak overflow di layar kecil */
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
            /* clamp: min 1.4rem, fluid 5vw+0.5rem, max 4.5rem */
            font-size: clamp(1.4rem, 5vw + 0.5rem, 4.5rem);
        }

        /* Landscape / short screens */
        @media (max-height: 500px) and (orientation: landscape) {
            .hero-title {
                font-size: clamp(1rem, 4vw, 1.75rem) !important;
            }
            .hero-content {
                padding: 0.5rem;
            }
            .video-credit {
                font-size: 0.7rem;
                bottom: 0.75rem;
                right: 1rem;
            }
        }
    </style>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* ── Video Switcher ── */
            const video1 = document.getElementById('hero-video-1');
            const video2 = document.getElementById('hero-video-2');

            if (!video1 || !video2) return;

            let currentVideo = video1;
            let nextVideo    = video2;
            let isPlaying    = false;

            function playVideo(video) {
                const p = video.play();
                if (p !== undefined) {
                    p.then(() => { isPlaying = true; })
                     .catch(err => { console.warn('Autoplay prevented:', err); isPlaying = false; });
                }
            }

            function switchVideo() {
                currentVideo.classList.remove('active');
                nextVideo.classList.add('active');
                playVideo(nextVideo);
                [currentVideo, nextVideo] = [nextVideo, currentVideo];
            }

            video1.addEventListener('ended', switchVideo);
            video2.addEventListener('ended', switchVideo);

            if (nextVideo.readyState < 2) nextVideo.load();
            playVideo(currentVideo);

            const startOnInteraction = function () {
                if (!isPlaying && currentVideo.paused) playVideo(currentVideo);
            };
            document.body.addEventListener('click',      startOnInteraction, { once: true });
            document.body.addEventListener('touchstart', startOnInteraction, { once: true });

            document.addEventListener('visibilitychange', function () {
                if (document.hidden) {
                    if (!currentVideo.paused) currentVideo.pause();
                } else {
                    if (currentVideo.paused && isPlaying) playVideo(currentVideo);
                }
            });
        });
    </script>
    @endpush

</x-app-layout>