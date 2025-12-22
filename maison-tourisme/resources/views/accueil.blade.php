<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Maison du Tourisme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex flex-col bg-slate-50 text-slate-900">

<!-- NAVBAR FULL WIDTH -->
<nav class="w-full bg-blue-900 border-b border-yellow-400/60">
    <div class="w-full px-8 py-4 flex items-center justify-between">

        <!-- Logo -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" class="h-9 rounded-md">
            <span class="text-white font-bold text-sm tracking-wide">
                Maison du Tourisme
            </span>
        </div>

        <!-- Navigation -->
        <div class="hidden md:flex gap-10 text-sm font-semibold">
           <a href="{{ route('apropos') }}" class="text-white hover:text-yellow-300 transition">
    À propos
</a>

            <a href="{{ route('contact') }}" class="text-white hover:text-yellow-300 transition">
    Contact
</a>

           <a href="{{ route('discussion') }}" class="text-white hover:text-yellow-300 transition">
    Discussion
</a>

        </div>

        <!-- Auth -->
        <div class="flex items-center gap-3 text-xs">
            @auth
                <span class="px-3 py-1 rounded-full bg-blue-800 text-yellow-300 border border-yellow-400/60">
                    {{ auth()->user()->name }}
                </span>

                <a href="{{ route('user.dashboard') }}"
                   class="px-4 py-1.5 rounded-full bg-yellow-400 text-blue-900 font-semibold hover:bg-yellow-300 transition">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-4 py-1.5 rounded-full bg-white text-blue-900 hover:bg-yellow-100 transition">
                        Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-4 py-1.5 rounded-full bg-white text-blue-900">
                    Connexion
                </a>
                <a href="{{ route('register') }}"
                   class="px-4 py-1.5 rounded-full bg-yellow-400 text-blue-900 font-semibold">
                    Inscription
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- CONTENU PRINCIPAL FULL WIDTH -->
<main class="flex-1 w-full px-8 py-10">

    <!-- BARRE DE CONTEXTE -->
    <div class="mb-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-blue-900">
            Explorer les sites touristiques
        </h1>

       <form method="GET" action="{{ route('accueil') }}" class="w-full sm:w-80">
    <input
        type="text"
        name="q"
        value="{{ request('q') }}"
        placeholder="Rechercher un site, une ville..."
        class="w-full rounded-xl border border-slate-300 px-4 py-2 text-sm focus:ring-4 focus:ring-yellow-200 focus:border-yellow-400 outline-none"
    >
</form>

    </div>

    <!-- LISTE DES SITES FULL WIDTH -->
    <section id="sites">
        @if($sites->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                @foreach($sites as $site)
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl transition flex flex-col">

                        @if($site->image_url)
                            <div class="relative overflow-hidden rounded-t-2xl">
                                <img
                                    src="{{ asset('storage/'.$site->image_url) }}"
                                    class="site-img h-48 w-full object-cover hover:scale-105 transition cursor-zoom-in"
                                >
                                <span class="absolute top-3 left-3 text-xs font-semibold px-3 py-1 rounded-full bg-blue-900 text-yellow-300">
                                    {{ $site->ville }}
                                </span>
                            </div>
                        @endif

                        <div class="p-5 flex flex-col flex-1">
                            <h2 class="font-bold text-blue-900 text-sm mb-2">
                                {{ $site->titre }}
                            </h2>

                            <p class="text-xs text-slate-600 leading-relaxed mb-4">
                                {{ Str::limit($site->description, 110) }}
                            </p>

                            <div class="mt-auto flex items-center justify-between">
                                <span class="text-[11px] font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">
                                    Disponible
                                </span>

                                <a href="{{ route('sites.show', $site->id) }}"
                                   class="text-xs font-semibold px-4 py-2 rounded-full bg-blue-900 text-yellow-300 hover:bg-blue-800 transition">
                                    Voir & réserver
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <p class="text-sm text-slate-600">Aucun site disponible pour le moment.</p>
        @endif
    </section>
</main>

<!-- LIGHTBOX -->
<div id="lightbox" class="fixed inset-0 hidden items-center justify-center bg-blue-950/90 z-50">
    <span id="lightboxClose" class="absolute top-6 right-8 text-yellow-400 text-3xl cursor-pointer">&times;</span>
    <img id="lightboxImg" class="max-w-[90%] max-h-[90%] rounded-2xl cursor-zoom-out">
</div>

<script>
document.querySelectorAll('.site-img').forEach(img => {
    img.addEventListener('click', () => {
        document.getElementById('lightboxImg').src = img.src;
        document.getElementById('lightbox').classList.remove('hidden');
        document.getElementById('lightbox').classList.add('flex');
    });
});

document.getElementById('lightboxClose').onclick = () => {
    document.getElementById('lightbox').classList.add('hidden');
};

document.getElementById('lightbox').onclick = e => {
    if (e.target.id === 'lightbox') e.target.classList.add('hidden');
};
</script>

</body>
</html>
