<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil – Maison du Tourisme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: radial-gradient(circle at top, #e0f2fe, #f9fafb);
            min-height: 100vh;
        }

        a { text-decoration: none; }

        /* NAVBAR */
        .mt-nav {
            width: 100%;
            background: #0f172a;
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(148, 163, 184, 0.4);
        }

        .mt-nav-inner {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        .mt-nav-logo {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .mt-logo-circle {
            width: 36px;
            height: 36px;
            border-radius: 999px;
            background: linear-gradient(135deg, #facc15, #f97316);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.8rem;
            color: #111827;
        }

        .mt-logo-text {
            display: flex;
            flex-direction: column;
        }

        .mt-logo-title {
            color: #e5e7eb;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .mt-logo-sub {
            color: #9ca3af;
            font-size: 0.7rem;
        }

        .mt-nav-links {
            display: flex;
            gap: 1.2rem;
            flex: 1;
            justify-content: center;
        }

        .mt-link {
            color: #e5e7eb;
            font-size: 0.85rem;
            padding-bottom: 2px;
            border-bottom: 2px solid transparent;
            transition: 0.18s ease;
        }

        .mt-link:hover {
            color: #facc15;
            border-bottom-color: #facc15;
        }

        .mt-nav-user {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }

        .mt-user-name {
            font-size: 0.8rem;
            background: rgba(248, 250, 252, 0.12);
            color: #f9fafb;
            padding: 0.35rem 0.8rem;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.7);
        }

        .mt-dashboard-btn {
            background: linear-gradient(90deg, #4f46e5, #0ea5e9);
            padding: 0.4rem 1rem;
            border-radius: 999px;
            border: none;
            font-size: 0.78rem;
            color: #f9fafb;
            font-weight: 700;
            cursor: pointer;
        }

        .mt-logout-btn {
            background: #e5e7eb;
            padding: 0.4rem 0.9rem;
            border-radius: 999px;
            border: none;
            font-size: 0.78rem;
            color: #111827;
            font-weight: 600;
            cursor: pointer;
        }

        .mt-dashboard-btn:hover,
        .mt-logout-btn:hover {
            filter: brightness(1.05);
        }

        /* CONTENU ACCUEIL */
        .accueil-wrapper {
            max-width: 1100px;
            margin: 0 auto;
            padding: 1.8rem 1.5rem 2.5rem;
        }

        .accueil-card {
            background: #ffffff;
            border-radius: 1.4rem;
            padding: 1.8rem 1.6rem;
            box-shadow: 0 18px 40px rgba(15,23,42,0.18);
            border: 1px solid rgba(148,163,184,0.45);
            margin-bottom: 2rem;
        }

        .accueil-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: .4rem;
            color: #0f172a;
        }

        .accueil-subtitle {
            font-size: .9rem;
            color: #475569;
            margin-bottom: 1.4rem;
        }

        .accueil-buttons {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .btn-main {
            border-radius: 999px;
            border: none;
            padding: 0.6rem 1.4rem;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: .18s ease;
        }

        .btn-dashboard {
            background: linear-gradient(90deg, #4f46e5, #0ea5e9);
            color: #f9fafb;
            box-shadow: 0 12px 28px rgba(59,130,246,0.45);
        }

        .btn-dashboard:hover {
            filter: brightness(1.05);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
        }

        /* SECTION SITES PUBLIÉS */
        .sites-section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.6rem;
        }

        .sites-section-sub {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 1.2rem;
        }

        .sites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.4rem;
        }

        .site-card {
            background: #ffffff;
            border-radius: 1.1rem;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 6px 18px rgba(15,23,42,0.12);
        }

        .site-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 0.8rem;
            margin-bottom: .7rem;
        }

        .site-title {
            font-size: 0.98rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.2rem;
        }

        .site-city {
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 0.4rem;
        }

        .site-desc {
            font-size: 0.8rem;
            color: #475569;
            margin-bottom: 0.7rem;
        }

        .site-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-reserver {
            border-radius: 999px;
            padding: 0.45rem 1rem;
            border: none;
            font-size: 0.8rem;
            font-weight: 600;
            background: #0ea5e9;
            color: #f9fafb;
            cursor: pointer;
        }

        .btn-reserver:hover {
            background: #0284c7;
        }

        .site-tag {
            font-size: 0.7rem;
            color: #16a34a;
            background: #dcfce7;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
        }

        @media (max-width: 800px) {
            .mt-nav-inner {
                flex-wrap: wrap;
                justify-content: center;
            }
            .mt-nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            .accueil-wrapper {
                padding-inline: 1rem;
            }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="mt-nav">
        <div class="mt-nav-inner">

            <div class="mt-nav-logo">
                <div class="mt-logo-circle">MT</div>
                <div class="mt-logo-text">
                    <div class="mt-logo-title">Maison du Tourisme</div>
                    <div class="mt-logo-sub">Préparez votre séjour au Togo</div>
                </div>
            </div>

            <div class="mt-nav-links">
                <a href="{{ url('/') }}" class="mt-link">Maison</a>
                <a href="#sites" class="mt-link">Réserver un site</a>
                <a href="#contact" class="mt-link">Contact</a>
            </div>

            <div class="mt-nav-user">
                <span class="mt-user-name">
                    {{ auth()->user()->name ?? 'Utilisateur' }}
                </span>

                <a href="{{ route('user.dashboard') }}">
                    <button type="button" class="mt-dashboard-btn">
                        Mon tableau de bord
                    </button>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mt-logout-btn">
                        Déconnexion
                    </button>
                </form>
            </div>

        </div>
    </nav>

    {{-- CONTENU ACCUEIL --}}
    <div class="accueil-wrapper">

        <div class="accueil-card">
            <div class="accueil-title">
                Bonjour, {{ auth()->user()->name ?? 'Utilisateur' }} 
            </div>
            <div class="accueil-subtitle">
                Bienvenue sur la Maison du Tourisme. Depuis ici, vous pouvez découvrir les sites publiés,
                préparer vos visites et gérer vos réservations avant votre arrivée.
            </div>

            <div class="accueil-buttons">
                <a href="#sites">
                    <button type="button" class="btn-main btn-dashboard">
                        Voir les sites disponibles
                    </button>
                </a>

                <a href="{{ route('user.dashboard') }}">
                    <button type="button" class="btn-main btn-secondary">
                        Accéder à mon tableau de bord
                    </button>
                </a>
            </div>
        </div>

        {{-- SECTION SITES PUBLIÉS --}}
        <section id="sites">
            <div class="sites-section-title">Sites touristiques publiés</div>
            <div class="sites-section-sub">
                Voici les sites actuellement publiés par la Maison du Tourisme et disponibles à la réservation.
            </div>

            @if($sites->count())
                <div class="sites-grid">
                    @foreach($sites as $site)
                        <div class="site-card">
                            @if($site->image_url)
    <img src="{{ asset('storage/' . $site->image_url) }}" class="site-img">
@endif


                            <div class="site-title">{{ $site->titre }}</div>
                            <div class="site-city">{{ $site->ville }}</div>
                            <div class="site-desc">
                                {{ \Illuminate\Support\Str::limit($site->description, 120) }}
                            </div>

                            <div class="site-actions">
                                <span class="site-tag">Disponible</span>
                                <button type="button" class="btn-reserver">
                                    Réserver ce site
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p style="font-size: 0.85rem; color: #6b7280;">
                    Aucun site n’a encore été publié. Revenez un peu plus tard.
                </p>
            @endif
        </section>


        {{-- SECTION CONTACT (placeholder, à compléter plus tard) --}}
        <section id="contact" style="margin-top: 2.5rem;">
            <div class="sites-section-title">Contact</div>
            <div class="sites-section-sub">
                Pour toute question ou assistance, veuillez contacter la Maison du Tourisme.
            </div>
        </section>

    </div>

</body>
</html>
