<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Maison du Tourisme') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Instrument Sans', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background: radial-gradient(circle at top left, #fefce8, #eff6ff 45%, #e0f2fe 75%);
        }

        .hero-wrapper {
            width: 100%;
            max-width: 1120px;
        }

        .hero-card {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            gap: 2.5rem;
            padding: 2.4rem 2.6rem;
            border-radius: 1.75rem;
            background: #ffffff;
            box-shadow:
                0 22px 55px rgba(15, 23, 42, 0.18),
                0 0 0 1px rgba(15, 23, 42, 0.04);
            overflow: hidden;
        }

        /* Décor de fond */
        .hero-card::before {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(250, 204, 21, 0.18), transparent 60%);
            top: -60px;
            right: -80px;
            pointer-events: none;
        }

        .hero-card::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.16), transparent 65%);
            bottom: -80px;
            left: -60px;
            pointer-events: none;
        }

        /* Colonne texte (gauche) */
        .hero-content {
            position: relative;
            z-index: 1;
            flex: 1 1 320px;
            min-width: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.32rem 0.9rem;
            border-radius: 999px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #1d4ed8;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            margin-bottom: 1rem;
        }

        .hero-pill-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #facc15;
        }

        .hero-title {
            font-size: clamp(2.1rem, 3.2vw, 2.7rem);
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 0.75rem 0;
        }

        .hero-highlight {
            color: #f59e0b;
        }

        .hero-subtitle {
            font-size: 0.96rem;
            color: #4b5563;
            line-height: 1.65;
            max-width: 480px;
            margin-bottom: 1.6rem;
        }

        .hero-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.6rem;
            font-size: 0.78rem;
            color: #6b7280;
        }

        .hero-badge {
            padding: 0.28rem 0.7rem;
            border-radius: 999px;
            border: 1px dashed #e5e7eb;
            background: #f9fafb;
        }

        .btn-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.9rem;
            margin-bottom: 1.25rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.8rem 1.9rem;
            border-radius: 999px;
            border: 1px solid transparent;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.18s ease-in-out;
            min-width: 150px;
            white-space: nowrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, #facc15, #f59e0b);
            color: #0f172a;
            border-color: #fbbf24;
            box-shadow:
                0 12px 32px rgba(250, 204, 21, 0.6),
                0 0 0 1px rgba(251, 191, 36, 0.75);
        }

        .btn-primary:hover {
            transform: translateY(-1px) scale(1.01);
            box-shadow:
                0 18px 40px rgba(251, 191, 36, 0.7),
                0 0 0 1px rgba(251, 191, 36, 0.95);
        }

        .btn-outline {
            background: #ffffff;
            color: #1d4ed8;
            border-color: #bfdbfe;
        }

        .btn-outline:hover {
            background: #eff6ff;
            border-color: #60a5fa;
            color: #1e40af;
        }

        .hero-note {
            font-size: 0.78rem;
            color: #9ca3af;
        }

        /* Colonne image (droite) – détachée */
        .hero-media {
            position: relative;
            flex: 1 1 320px;
            max-width: 440px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        /* carte flottante derrière l'image */
        .media-background-card {
            position: absolute;
            inset: auto;
            right: 0.4rem;
            top: 1.2rem;
            width: 86%;
            height: 82%;
            border-radius: 1.7rem;
            background: linear-gradient(145deg, #eff6ff, #fee2e2);
            opacity: 0.9;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.25);
            transform: translate(10px, 10px);
        }

        .media-frame {
            position: relative;
            width: 100%;
            max-width: 420px;
            aspect-ratio: 4 / 3;
            border-radius: 1.6rem;
            overflow: hidden;
            background: #020617;
            box-shadow:
                0 18px 45px rgba(15, 23, 42, 0.55),
                0 0 0 1px rgba(15, 23, 42, 0.45);
        }

        .media-gradient-ring {
            position: absolute;
            inset: 0;
            border-radius: inherit;
            pointer-events: none;
            background: linear-gradient(135deg, rgba(250, 204, 21, 0.4), rgba(59, 130, 246, 0.45));
            opacity: 0.35;
            mix-blend-mode: soft-light;
        }

        .slider {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .slider img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            animation: sliderFade 20s infinite;
        }

        .slider img:nth-child(1) { animation-delay: 0s; }
        .slider img:nth-child(2) { animation-delay: 5s; }
        .slider img:nth-child(3) { animation-delay: 10s; }
        .slider img:nth-child(4) { animation-delay: 15s; }

        @keyframes sliderFade {
            0%   { opacity: 0; transform: scale(1); }
            5%   { opacity: 1; transform: scale(1.01); }
            20%  { opacity: 1; transform: scale(1.03); }
            25%  { opacity: 0; transform: scale(1.04); }
            100% { opacity: 0; transform: scale(1.04); }
        }

        .media-tag {
            position: absolute;
            left: 1rem;
            bottom: 1rem;
            padding: 0.35rem 0.8rem;
            font-size: 0.72rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.85);
            color: #facc15;
            border: 1px solid rgba(250, 204, 21, 0.7);
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .media-tag::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #22c55e;
        }

        @media (max-width: 900px) {
            .hero-card {
                padding: 1.8rem 1.5rem 2rem;
            }
        }

        @media (max-width: 768px) {
            .hero-card {
                flex-direction: column;
            }

            /* sur mobile : image en haut, texte en bas pour un meilleur impact */
            .hero-media {
                order: -1;
                max-width: 100%;
            }

            .media-background-card {
                display: none;
            }

            .hero-content {
                text-align: left;
            }

            .hero-subtitle {
                max-width: 100%;
            }

            .btn-row {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 0.75rem;
            }

            .hero-card {
                border-radius: 1.3rem;
                padding: 1.6rem 1.2rem 1.9rem;
            }

            .btn-row {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="hero-wrapper">
    <div class="hero-card">

        {{-- Colonne texte gauche --}}
        <div class="hero-content">
            <div class="hero-pill">
                <span class="hero-pill-dot"></span>
                <span>Maison du Tourisme</span>
            </div>

            <h1 class="hero-title">
                Explorez, réservez et vivez
                <span class="hero-highlight">le Togo autrement.</span>
            </h1>

            <p class="hero-subtitle">
                Accédez à votre espace pour gérer vos réservations, découvrir les
                sites touristiques et planifier vos visites en toute simplicité,
                que vous soyez visiteur, guide ou agence.
            </p>

            <div class="hero-badges">
                <span class="hero-badge">Réservations en ligne</span>
                <span class="hero-badge">Sites naturels &amp; culturels</span>
                <span class="hero-badge">Expérience 100% digitale</span>
            </div>

            <div class="btn-row">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        Se connecter
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline">
                            S'inscrire
                        </a>
                    @endif
                @else
                    <span>Aucune route d’authentification détectée.</span>
                @endif
            </div>

            <div class="hero-note">
                &copy; {{ date('Y') }} {{ config('app.name', 'Maison du Tourisme') }} — Plateforme de réservation touristique.
            </div>
        </div>

        {{-- Colonne image droite, détachée --}}
        <div class="hero-media">
            <div class="media-background-card"></div>

            <div class="media-frame">
                <div class="slider">
                    <img src="{{ asset('images/ge1.png') }}" alt="Site touristique 1">
                    <img src="{{ asset('images/fs.jpg') }}" alt="Site touristique 2">
                    <img src="{{ asset('images/ms.jpg') }}" alt="Site touristique 3">
                    <img src="{{ asset('images/aq.jpg') }}" alt="Site touristique 4">
                </div>
                <div class="media-gradient-ring"></div>
                <div class="media-tag">
                    Découvertes au Togo
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
