<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion – Maison du Tourisme</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 px-6">

    <div class="w-full max-w-5xl bg-blue-950/95 border border-blue-700/50 rounded-[28px] shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

        <!-- PANEL GAUCHE -->
        <div class="hidden md:flex flex-col justify-between p-12 bg-gradient-to-br from-blue-900 to-blue-950 text-blue-50">

            <div>
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Maison du Tourisme"
                    class="h-14 w-auto mb-6 rounded-xl shadow-lg"
                />

                <h2 class="uppercase tracking-widest text-sm font-semibold">
                    Maison du Tourisme
                </h2>
                <p class="text-blue-300 text-xs tracking-wider mt-1">
                    Réservez • Explorez • Respirez
                </p>

                <div class="mt-10">
                    <h3 class="text-3xl font-extrabold leading-tight">
                        Votre <span class="text-yellow-300">espace pro</span><br>
                        de gestion touristique
                    </h3>
                    <p class="mt-4 text-blue-200 text-sm max-w-sm">
                        Accédez au tableau de bord, gérez les réservations et pilotez vos sites touristiques en toute simplicité.
                    </p>

                    <div class="flex flex-wrap gap-2 mt-6 text-xs">
                        <span class="px-3 py-1 rounded-full bg-blue-800 border border-blue-600 flex items-center gap-2">
                            <span class="w-2 h-2 bg-yellow-400 rounded-full"></span>
                            Réservations en temps réel
                        </span>
                        <span class="px-3 py-1 rounded-full bg-blue-800 border border-blue-600 flex items-center gap-2">
                            <span class="w-2 h-2 bg-yellow-400 rounded-full"></span>
                            Gestion des sites
                        </span>
                        <span class="px-3 py-1 rounded-full bg-blue-800 border border-blue-600 flex items-center gap-2">
                            <span class="w-2 h-2 bg-yellow-400 rounded-full"></span>
                            Vue globale visiteurs
                        </span>
                    </div>
                </div>
            </div>

            <p class="text-xs text-blue-400">
                <strong class="text-blue-200">Conseil :</strong> Ne partagez jamais vos identifiants.
            </p>
        </div>

        <!-- PANEL DROIT -->
        <div class="bg-slate-50 p-10 sm:p-12">

            <div class="inline-flex items-center gap-2 text-xs px-4 py-1 rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300 mb-6">
                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                Accès sécurisé – Personnel autorisé
            </div>

            <h1 class="text-2xl font-extrabold text-blue-950">
                Connexion
            </h1>
            <p class="text-sm text-slate-600 mt-1 mb-8">
                Connectez-vous pour accéder au tableau de bord.
            </p>

            {{-- Message session --}}
            @if (session('status'))
                <div class="mb-4 text-center text-sm font-semibold text-green-700 bg-green-100 rounded-full py-2">
                    {{ session('status') }}
                </div>
            @endif

            <!-- FORMULAIRE -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- EMAIL -->
                <div>
                    <label class="block text-sm font-semibold text-blue-950 mb-1">
                        Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 outline-none"
                        placeholder="vous@maisondutourisme.tg"
                    >
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- MOT DE PASSE -->
                <div>
                    <label class="block text-sm font-semibold text-blue-950 mb-1">
                        Mot de passe
                    </label>
                    <input
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 outline-none"
                        placeholder="Votre mot de passe"
                    >
                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- REMEMBER -->
                <div class="flex items-center text-sm text-slate-600">
                    <input
                        type="checkbox"
                        name="remember"
                        class="w-4 h-4 mr-2 accent-yellow-400"
                        {{ old('remember') ? 'checked' : '' }}
                    >
                    Se souvenir de moi
                </div>

                <!-- SUBMIT -->
                <button
                    type="submit"
                    class="w-full mt-4 py-3 rounded-full font-bold text-blue-950 bg-gradient-to-r from-yellow-300 to-yellow-400 hover:brightness-105 shadow-lg transition"
                >
                    Se connecter
                </button>

                <!-- LIEN INSCRIPTION -->
                @if (Route::has('register'))
                    <p class="text-center text-sm text-slate-600 mt-4">
                        Vous n’avez pas encore de compte ?
                        <a
                            href="{{ route('register') }}"
                            class="font-semibold text-blue-900 hover:text-yellow-500 hover:underline transition"
                        >
                            Créer un compte
                        </a>
                    </p>
                @endif

                <p class="text-center text-[11px] tracking-widest text-slate-400 mt-6 uppercase">
                    © {{ date('Y') }} Maison du Tourisme
                </p>
            </form>
        </div>

    </div>

</body>
</html>
