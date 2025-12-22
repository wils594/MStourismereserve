<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $site->titre }} – Maison du Tourisme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 text-slate-900">

<main class="max-w-3xl mx-auto px-4 py-10">

    <!-- TITRE -->
    <h1 class="text-3xl font-bold text-blue-900 mb-4">
        {{ $site->titre }}
    </h1>

    <!-- VILLE -->
    <p class="text-sm text-slate-600 mb-4">
        📍 {{ $site->ville }}
    </p>

    <!-- IMAGE -->
    @if($site->image_url)
        <img
            src="{{ asset('storage/'.$site->image_url) }}"
            class="w-full h-64 object-cover rounded-xl mb-6"
        >
    @endif

    <!-- DESCRIPTION -->
    <p class="text-slate-700 leading-relaxed mb-8">
        {{ $site->description }}
    </p>

    <!-- ACTIONS -->
    <div class="flex gap-4">
        <!-- 🔹 BOUTON RÉSERVER -->
        @auth
        <a href="{{ route('reservation.create', $site) }}"
           class="px-6 py-3 rounded-full bg-blue-900 text-white
                  font-semibold hover:bg-blue-800 transition">
            Réserver ce site
        </a>
        @else
        <a href="{{ route('login') }}"
           class="px-6 py-3 rounded-full bg-gray-400 text-white font-semibold">
            Connectez-vous pour réserver
        </a>
        @endauth
    </div>

</main>

</body>
</html>
