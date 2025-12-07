<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace client – Maison du Tourisme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        /* RESET SIMPLE */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: radial-gradient(circle at top, #e0f2fe, #f9fafb, #eef2ff);
            color: #0f172a;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
        }

        /* NAVBAR */
        .mt-nav {
            width: 100%;
            background: #0f172a;
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(148, 163, 184, 0.4);
        }

        .mt-nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        /* Logo */
        .mt-nav-logo {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .mt-logo-circle {
            width: 38px;
            height: 38px;
            border-radius: 999px;
            background: linear-gradient(135deg, #facc15, #f97316);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.85rem;
            color: #111827;
            box-shadow: 0 5px 15px rgba(249, 115, 22, 0.5);
        }

        .mt-logo-text {
            display: flex;
            flex-direction: column;
        }

        .mt-logo-title {
            color: #e5e7eb;
            font-size: 0.95rem;
            font-weight: 700;
        }

        .mt-logo-sub {
            color: #9ca3af;
            font-size: 0.7rem;
        }

        /* Liens navigation */
        .mt-nav-links {
            display: flex;
            gap: 1.3rem;
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

        /* Zone utilisateur */
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

        /* AJOUT : bouton Mon tableau de bord */
        .mt-dashboard-btn {
            background: linear-gradient(90deg, #4f46e5, #0ea5e9);
            padding: 0.4rem 1rem;
            border-radius: 999px;
            border: none;
            font-size: 0.78rem;
            color: #f9fafb;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 5px 16px rgba(14, 165, 233, 0.4);
            transition: 0.18s ease;
        }

        .mt-dashboard-btn:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
        }

        .mt-logout-btn {
            background: linear-gradient(90deg, #f97316, #facc15);
            padding: 0.4rem 0.95rem;
            border-radius: 999px;
            border: none;
            font-size: 0.78rem;
            font-weight: 700;
            color: #111827;
            cursor: pointer;
            box-shadow: 0 5px 16px rgba(249, 115, 22, 0.5);
            transition: 0.18s ease;
        }

        .mt-logout-btn:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
        }

        /* Layout page */
        .page-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.8rem 1.5rem 2.5rem;
        }

        /* Header principal (ton espace client) */
        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
            padding: 1.6rem 1.8rem;
            border-radius: 1.4rem;
            background: radial-gradient(circle at top left, #e0f2fe, #fef9c3);
            border: 1px solid rgba(148, 163, 184, 0.5);
            box-shadow:
                0 18px 40px rgba(15, 23, 42, 0.18),
                0 0 0 1px rgba(148, 163, 184, 0.18);
            margin-bottom: 1.8rem;
        }

        .main-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: 0.01em;
        }

        .main-subtitle {
            margin-top: 0.35rem;
            font-size: 0.9rem;
            color: #475569;
        }

        .main-header-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .badge-sejour {
            font-size: 0.75rem;
            padding: 0.35rem 0.7rem;
            border-radius: 999px;
            background: rgba(15, 118, 110, 0.08);
            color: #065f46;
            border: 1px solid rgba(16, 185, 129, 0.4);
        }

        /* Cartes d’actions */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.4rem;
            margin-top: 1.2rem;
        }

        .action-card {
            background: #ffffff;
            border-radius: 1.1rem;
            padding: 1.2rem 1.3rem;
            border: 1px solid rgba(148, 163, 184, 0.35);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
            transition: 0.2s ease;
            cursor: pointer;
        }

        .action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.12);
        }

        .action-title {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.4rem;
            color: #0f172a;
        }

        .action-text {
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 0.6rem;
        }

        .action-link {
            font-size: 0.78rem;
            color: #2563eb;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .mt-nav-inner {
                flex-wrap: wrap;
                justify-content: center;
            }

            .mt-nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .page-wrapper {
                padding-inline: 1rem;
            }

            .main-header {
                flex-direction: column;
                align-items: flex-start;
                padding: 1.3rem 1.2rem;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    {{-- NAVBAR UTILISATEUR --}}
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
                <a href="#a-propos" class="mt-link">À propos</a>
                <a href="#reservation" class="mt-link">Réservation de site</a>
                <a href="#contact" class="mt-link">Contact</a>
                <a href="#assistance" class="mt-link">Assistance</a>
            </div>

            <div class="mt-nav-user">

                {{-- Nom utilisateur --}}
                <span class="mt-user-name">
                    {{ auth()->user()->name ?? 'Utilisateur' }}
                </span>

                {{-- AJOUT : bouton Mon tableau de bord --}}
                <a href="{{ route('user.dashboard') }}">
                    <button class="mt-dashboard-btn">
                        Mon tableau de bord
                    </button>
                </a>

                {{-- Déconnexion --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mt-logout-btn">
                        Déconnexion
                    </button>
                </form>

            </div>

        </div>
    </nav>

    {{-- CONTENU PRINCIPAL --}}
    <div class="page-wrapper">

        <div class="main-header">
            <div>
                <div class="main-title">
                    Bonjour, {{ auth()->user()->name ?? 'Utilisateur' }} 👋
                </div>
                <div class="main-subtitle">
                    Bienvenue dans votre espace client de la Maison du Tourisme.
                    Ici, vous pouvez découvrir les sites disponibles, préparer vos visites
                    et suivre vos réservations avant votre arrivée.
                </div>
            </div>

            <div class="main-header-right">
                <div class="badge-sejour">
                    Préparez votre séjour en quelques clics
                </div>
            </div>
        </div>

        {{-- CARTES D’ACTIONS PRINCIPALES --}}
        <div class="actions-grid">

            <div class="action-card" id="reservation">
                <div class="action-title">Réserver un site</div>
                <div class="action-text">
                    Parcourez les sites touristiques disponibles et réservez vos visites à l’avance.
                </div>
                <a href="#" class="action-link">Voir les sites &rarr;</a>
            </div>

            <div class="action-card">
                <div class="action-title">Mes réservations</div>
                <div class="action-text">
                    Consultez vos réservations en cours, les dates prévues et les détails de vos visites.
                </div>
                <a href="#" class="action-link">Accéder à mes réservations &rarr;</a>
            </div>

            <div class="action-card" id="assistance">
                <div class="action-title">Assistance Maison du Tourisme</div>
                <div class="action-text">
                    Besoin d’aide pour organiser votre séjour ou modifier une réservation ?
                </div>
                <a href="#" class="action-link">Contacter l’assistance &rarr;</a>
            </div>

        </div>

    </div>

</body>
</html>
