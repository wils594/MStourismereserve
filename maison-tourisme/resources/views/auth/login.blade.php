<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-blue-700 to-blue-500">

    <div class="w-full max-w-md px-8 py-10 bg-white/95 shadow-2xl rounded-2xl border-t-4 border-yellow-400">

        <!-- Titre -->
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-extrabold text-blue-900 tracking-wide">
                Connexion
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Accédez à votre espace sécurisé
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-green-600 text-center font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <!-- Formulaire -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-blue-900 font-semibold">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="block mt-1 w-full rounded-xl border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-blue-900 font-semibold">Mot de passe</label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-xs text-blue-700 hover:text-blue-900 hover:underline">
                           Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    class="block mt-1 w-full rounded-xl border-gray-300 focus:border-yellow-400 focus:ring-yellow-400"
                >

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded border-gray-300 text-yellow-400 shadow-sm focus:ring-yellow-400"
                >
                <label for="remember_me" class="ms-2 text-sm text-gray-600">
                    Se souvenir de moi
                </label>
            </div>

            <!-- Bouton -->
            <button
                type="submit"
                class="w-full mt-4 py-3 rounded-xl bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-semibold border border-yellow-500 shadow-md hover:shadow-lg transition">
                Connexion
            </button>
        </form>
    </div>

</body>
</html>
