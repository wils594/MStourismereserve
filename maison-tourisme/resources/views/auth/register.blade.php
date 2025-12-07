<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription – Maison du Tourisme</title>

    {{-- Garde @vite si ton projet l’utilise, sinon tu peux le retirer --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* RESET léger */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --blue-dark: #0f172a;
            --blue-main: #1e3a8a;
            --orange-main: #f97316;
            --orange-soft: #ffedd5;
            --text-muted: #6b7280;
        }

        body {
            min-height: 100vh;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0b1120, #1e3a8a 45%, #0369a1);
            color: var(--blue-dark);
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            filter: blur(45px);
            opacity: 0.5;
            z-index: -1;
        }

        body::before {
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, #f97316, transparent 70%);
            top: -80px;
            right: -60px;
        }

        body::after {
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, #22c55e, transparent 70%);
            bottom: -60px;
            left: -40px;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 960px;
            background: rgba(15, 23, 42, 0.96);
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.6);
            box-shadow: 0 24px 80px rgba(15, 23, 42, 0.75);
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
            overflow: hidden;
            position: relative;
        }

        .auth-wrapper::before {
            content: "";
            position: absolute;
            inset: 0;
            height: 4px;
            background: linear-gradient(90deg, #f97316, #facc15, #22c55e);
        }

        /* PANEL GAUCHE */
        .auth-panel-left {
            padding: 3rem 2.8rem;
            background: radial-gradient(circle at top left, rgba(56, 189, 248, 0.2), transparent 60%);
            color: #e5e7eb;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .logo-circle {
            width: 52px;
            height: 52px;
            border-radius: 999px;
            background: radial-gradient(circle at 30% 20%, #fef3c7, #f97316);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.4rem;
            color: #1f2933;
            box-shadow: 0 12px 40px rgba(249, 115, 22, 0.7);
            margin-bottom: 1.5rem;
        }

        .brand-title {
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #e5e7eb;
        }

        .brand-tagline {
            margin-top: 0.4rem;
            font-size: 0.86rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #9ca3af;
        }

        .hero-text {
            margin-top: 2rem;
        }

        .hero-title {
            font-size: 1.9rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .hero-title span {
            color: #fed7aa;
        }

        .hero-desc {
            margin-top: 0.8rem;
            font-size: 0.95rem;
            color: #cbd5f5;
            max-width: 320px;
        }

        .hero-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1.4rem;
        }

        .pill {
            font-size: 0.75rem;
            padding: 0.3rem 0.7rem;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(148, 163, 184, 0.6);
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            color: #e5e7eb;
        }

        .pill-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #f97316;
        }

        .hero-footer {
            margin-top: 3rem;
            font-size: 0.78rem;
            color: #9ca3af;
        }

        .hero-footer strong {
            color: #e5e7eb;
        }

        /* PANEL DROIT */
        .auth-panel-right {
            background: #f9fafb;
            padding: 3.2rem 2.6rem;
            position: relative;
        }

        .panel-badge {
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.25rem 0.7rem;
            border-radius: 999px;
            background: var(--orange-soft);
            color: #9a3412;
            border: 1px solid rgba(248, 171, 108, 0.6);
            margin-bottom: 1.4rem;
        }

        .panel-badge-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: #22c55e;
        }

        .card-header {
            margin-bottom: 1.8rem;
        }

        .card-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--blue-dark);
        }

        .card-subtitle {
            margin-top: 0.45rem;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .status {
            margin-bottom: 1rem;
            padding: 0.55rem 0.9rem;
            background-color: #dcfce7;
            color: #15803d;
            font-weight: 600;
            font-size: 0.85rem;
            text-align: center;
            border-radius: 999px;
        }

        .form-group {
            margin-bottom: 1.1rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--blue-dark);
            margin-bottom: 0.25rem;
        }

        .label-hint {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-muted);
        }

        .input-wrapper {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 0.78rem 0.9rem;
            padding-right: 2.6rem;
            border-radius: 0.9rem;
            border: 1px solid #d1d5db;
            font-size: 0.95rem;
            outline: none;
            background-color: #ffffff;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
            transition: border-color 0.18s ease, box-shadow 0.18s ease, transform 0.08s ease;
        }

        .form-input:focus {
            border-color: var(--orange-main);
            box-shadow: 0 0 0 3px rgba(248, 171, 108, 0.35);
            transform: translateY(-1px);
        }

        .input-icon {
            position: absolute;
            right: 0.8rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.9rem;
            color: #9ca3af;
        }

        .toggle-password {
            position: absolute;
            right: 0.6rem;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            font-size: 0.8rem;
            color: var(--blue-main);
            cursor: pointer;
        }

        .error-message {
            margin-top: 0.3rem;
            font-size: 0.78rem;
            color: #dc2626;
        }

        .btn-submit {
            margin-top: 0.9rem;
            width: 100%;
            padding: 0.9rem 1rem;
            border-radius: 999px;
            border: none;
            background: linear-gradient(90deg, #f97316, #facc15);
            color: #111827;
            font-weight: 700;
            font-size: 0.98rem;
            cursor: pointer;
            box-shadow: 0 12px 28px rgba(249, 115, 22, 0.55);
            transition: transform 0.12s ease, box-shadow 0.12s ease, filter 0.12s ease;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 36px rgba(249, 115, 22, 0.7);
            filter: brightness(1.03);
        }

        .btn-submit:active {
            transform: translateY(1px);
            box-shadow: 0 8px 18px rgba(249, 115, 22, 0.6);
        }

        .below-button {
            margin-top: 0.8rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .below-button a {
            color: var(--blue-main);
            text-decoration: none;
        }

        .below-button a:hover {
            text-decoration: underline;
            color: #0f172a;
        }

        .footer {
            margin-top: 1.4rem;
            text-align: center;
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #9ca3af;
        }

        @media (max-width: 820px) {
            .auth-wrapper {
                grid-template-columns: minmax(0, 1fr);
            }
            .auth-panel-left {
                display: none;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 1rem;
            }
            .auth-panel-right {
                padding: 2.2rem 1.6rem;
            }
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">
        {{-- PANEL GAUCHE : Identité --}}
        <div class="auth-panel-left">
            <div>
                <div class="logo-circle">MT</div>
                <div>
                    <div class="brand-title">Maison du Tourisme</div>
                    <div class="brand-tagline">Réservez. Explorez. Respirez.</div>
                </div>

                <div class="hero-text">
                    <h2 class="hero-title">
                        Créez votre <span>compte</span><br>
                        et gérez vos réservations.
                    </h2>
                    <p class="hero-desc">
                        Inscrivez-vous pour accéder à l’application, suivre vos visites, vos réservations
                        et profiter d’un accompagnement personnalisé.
                    </p>

                    <div class="hero-pills">
                        <div class="pill">
                            <span class="pill-dot"></span>
                            Accès sécurisé à l’espace client
                        </div>
                        <div class="pill">
                            <span class="pill-dot"></span>
                            Historique de vos visites
                        </div>
                        <div class="pill">
                            <span class="pill-dot"></span>
                            Gestion simplifiée de vos séjours
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-footer">
                <strong>Bon à savoir :</strong> utilisez une adresse email que vous consultez
                régulièrement pour recevoir vos confirmations de réservation.
            </div>
        </div>

        {{-- PANEL DROIT : Formulaire d’inscription --}}
        <div class="auth-panel-right">
            <div class="panel-badge">
                <span class="panel-badge-dot"></span>
                Créez votre accès en quelques secondes
            </div>

            <div class="card-header">
                <h1 class="card-title">Inscription</h1>
                <p class="card-subtitle">
                    Créez votre compte pour accéder à l'application de la Maison du Tourisme.
                </p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="status">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nom --}}
                <div class="form-group">
                    <label for="name" class="form-label">
                        <span>Nom complet</span>
                        <span class="label-hint">Tel qu’il apparaît sur vos documents</span>
                    </label>
                    <div class="input-wrapper">
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            class="form-input"
                            placeholder="Ex : Kossi Amegan"
                        >
                        <span class="input-icon">👤</span>
                    </div>
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label">
                        <span>Adresse email</span>
                        <span class="label-hint">Utilisée pour vos confirmations</span>
                    </label>
                    <div class="input-wrapper">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="form-input"
                            placeholder="vous@exemple.com"
                        >
                        <span class="input-icon">@</span>
                    </div>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Mot de passe --}}
                <div class="form-group">
                    <label for="password" class="form-label">
                        <span>Mot de passe</span>
                        <span class="label-hint">Au moins 8 caractères</span>
                    </label>
                    <div class="input-wrapper">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            class="form-input"
                            placeholder="Choisissez un mot de passe sécurisé"
                        >
                        <button type="button" class="toggle-password" data-target="password">
                            Afficher
                        </button>
                    </div>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmation mot de passe --}}
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <span>Confirmer le mot de passe</span>
                        <span class="label-hint">Doit être identique au précédent</span>
                    </label>
                    <div class="input-wrapper">
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            class="form-input"
                            placeholder="Répétez votre mot de passe"
                        >
                        <button type="button" class="toggle-password" data-target="password_confirmation">
                            Afficher
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bouton --}}
                <button type="submit" class="btn-submit">
                    S'inscrire
                </button>

                <div class="below-button">
                    <span>Déjà inscrit ?</span>
                    <a href="{{ route('login') }}">Connectez-vous</a>
                </div>

                <div class="footer">
                    © {{ date('Y') }} Maison du Tourisme – Tous droits réservés
                </div>
            </form>
        </div>
    </div>

    <script>
        // Afficher / masquer les mots de passe
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.getAttribute('data-target');
                const input = document.getElementById(targetId);

                if (!input) return;

                const type = input.type === 'password' ? 'text' : 'password';
                input.type = type;
                btn.textContent = type === 'password' ? 'Afficher' : 'Masquer';
            });
        });
    </script>
</body>
</html>
