<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-blue-700 to-blue-500">

    <div class="w-full max-w-md px-8 py-10 bg-white/95 shadow-2xl rounded-2xl border-t-4 border-yellow-400">

        <!-- Titre -->
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-extrabold text-blue-900 tracking-wide">
                Inscription
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Créez votre compte pour accéder à l'application
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-green-600 text-center font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulaire -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-blue-900 font-semibold">Nom</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    class="block mt-1 w-full rounded-xl border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-blue-900 font-semibold">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="block mt-1 w-full rounded-xl border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-blue-900 font-semibold">Mot de passe</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    class="block mt-1 w-full rounded-xl border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-blue-900 font-semibold">Confirmer le mot de passe</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    class="block mt-1 w-full rounded-xl border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                >
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bouton -->
            <button
                type="submit"
                class="w-full py-3 rounded-xl bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-semibold border border-yellow-500 shadow-md hover:shadow-lg transition"
            >
                S'inscrire
            </button>

            <!-- Déjà inscrit -->
            <div class="text-center mt-3">
                <a
                    href="{{ route('login') }}"
                    class="text-sm text-blue-700 hover:text-blue-900 hover:underline"
                >
                    Déjà inscrit ? Connectez-vous
                </a>
            </div>

        </form>
    </div>

</body>
</html>
