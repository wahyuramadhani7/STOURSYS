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

            <!-- Credit sumber video -->
            <div class="video-credit">
                Sumber: <a href="https://youtu.be/6DiEVUSrRqE" target="_blank" rel="noopener noreferrer">Studio Sunday</a> – Aerial Drone Videography Borobudur
            </div>

            <!-- Overlay -->
            <div class="hero-overlay"></div>

            <!-- Content -->
            <div class="hero-content">
                <p class="hero-eyebrow">Stoursys — Kawasan Borobudur</p>
                <h1 class="hero-title">
                    SMART TOURISM SYSTEM<br>
                    KAWASAN WISATA BOROBUDUR
                </h1>
                <!-- Decorative line -->
                <div class="hero-line"></div>
                <p class="hero-sub">Warisan Dunia UNESCO</p>
            </div>

        </div>
    </section>

    <style>
        :root {
            --cream:    #faf6f0;
            --sand:     #e8dcc8;
            --terracota:#c45c2e;
            --brick:    #9c3a1a;
            --gold:     #c9952a;
            --charcoal: #1c1917;
            --ink:      #0d0b09;
        }

        x-app-layout {
            display: block;
            margin: 0; padding: 0;
            width: 100%; height: 100%;
        }

        /* ========================
           DESKTOP: full viewport fill, no scroll
           ======================== */
        .hero-section {
            width: 100%;
            height: 100%;
            position: relative;
            margin: 0; padding: 0;
            display: block;
            line-height: 0;
            overflow: hidden;
        }

        .hero-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: block;
            line-height: 0;
            overflow: hidden;
        }

        /* Videos */
        .hero-video {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            object-fit: cover;
            object-position: center;
            opacity: 0;
            transition: opacity 1.2s ease-in-out;
            z-index: 1;
            display: block;
            vertical-align: bottom;
        }
        .hero-video.active { opacity: 1; z-index: 2; }

        /* Overlay */
        .hero-overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: linear-gradient(
                to bottom,
                rgba(13,11,9,0.25) 0%,
                rgba(13,11,9,0.35) 50%,
                rgba(13,11,9,0.65) 100%
            );
            z-index: 3;
            pointer-events: none;
        }

        /* Video credit */
        .video-credit {
            position: absolute;
            bottom: 1.25rem; right: 1.5rem;
            z-index: 5;
            font-family: 'Space Mono', monospace;
            font-size: 0.62rem;
            letter-spacing: 0.12em;
            color: rgba(250,246,240,0.45);
            text-shadow: 0 1px 4px rgba(0,0,0,0.9);
            pointer-events: auto;
            max-width: 80%;
            line-height: 1.4;
        }
        .video-credit a {
            color: rgba(250,246,240,0.7);
            text-decoration: none;
            border-bottom: 1px solid rgba(250,246,240,0.3);
            transition: color 0.3s ease;
        }
        .video-credit a:hover { color: var(--gold); }

        /* Hero content */
        .hero-content {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-align: center;
            padding: 2rem;
        }

        /* Eyebrow */
        .hero-eyebrow {
            font-family: 'Space Mono', monospace;
            font-size: clamp(0.55rem, 1vw, 0.72rem);
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            opacity: 0.9;
        }
        .hero-eyebrow::before,
        .hero-eyebrow::after {
            content: '';
            display: block;
            width: clamp(1rem, 3vw, 2.5rem);
            height: 1px;
            background: var(--gold);
            opacity: 0.6;
        }

        /* Title */
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            letter-spacing: -0.01em;
            line-height: 1.1;
            margin: 0;
            color: var(--cream);
            text-shadow: 0 4px 24px rgba(0,0,0,0.6), 0 1px 3px rgba(0,0,0,0.8);
            word-wrap: break-word;
            max-width: 100%;
            font-size: clamp(1.6rem, 5vw + 0.5rem, 4.5rem);
        }

        /* Decorative line */
        .hero-line {
            width: clamp(2rem, 4vw, 4rem);
            height: 2px;
            background: linear-gradient(to right, var(--terracota), var(--gold));
            margin: 1.5rem auto 1.25rem;
            opacity: 0.8;
        }

        /* Sub-label */
        .hero-sub {
            font-family: 'Space Mono', monospace;
            font-size: clamp(0.55rem, 0.9vw, 0.7rem);
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: rgba(250,246,240,0.45);
        }

        /* ========================
           MOBILE: allow slight scroll so footer peeks
           ======================== */
        @media (max-width: 768px) {
            .hero-section {
                height: auto;
                min-height: 0;
                overflow: visible;
            }

            .hero-container {
                height: 64vh;
                min-height: 320px;
                overflow: hidden;
            }

            .hero-video {
                height: 100%;
            }

            .hero-content {
                height: 100%;
                padding: 1.5rem 1.25rem;
            }

            .video-credit {
                font-size: 0.58rem;
                bottom: 1rem;
                right: 1rem;
                max-width: 70%;
            }
        }

        /* Landscape / short screens */
        @media (max-height: 500px) and (orientation: landscape) {
            .hero-title    { font-size: clamp(1rem, 4vw, 1.75rem) !important; }
            .hero-content  { padding: 0.5rem; }
            .video-credit  { font-size: 0.6rem; bottom: 0.75rem; right: 1rem; }
            .hero-eyebrow  { display: none; }
            .hero-line, .hero-sub { display: none; }
        }

        @media (max-width: 640px) {
            .video-credit { font-size: 0.58rem; bottom: 1rem; right: 1rem; max-width: 70%; }
            .hero-eyebrow { gap: 0.6rem; }
        }
    </style>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

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