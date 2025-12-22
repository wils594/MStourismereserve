<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>À propos – Maison du Tourisme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex flex-col bg-slate-50 text-slate-900">

<!-- NAVBAR -->
<nav class="w-full bg-blue-900 border-b border-yellow-400/60">
    <div class="w-full px-8 py-4 flex items-center justify-between">

        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" class="h-9 rounded-md">
            <span class="text-white font-bold text-sm tracking-wide">
                Maison du Tourisme
            </span>
        </div>

        <div class="hidden md:flex gap-10 text-sm font-semibold">
            <a href="{{ route('accueil') }}" class="text-white hover:text-yellow-300">Accueil</a>
            <a href="{{ route('apropos') }}" class="text-yellow-300">À propos</a>
            <a href="#contact" class="text-white hover:text-yellow-300">Contact</a>
        </div>
    </div>
</nav>

<!-- CONTENU -->
<main class="flex-1 w-full px-8 py-14">

    <section class="max-w-4xl mx-auto bg-white rounded-2xl border border-slate-200 shadow-sm p-10">

        <h1 class="text-3xl font-bold text-blue-900 mb-6">
            À propos de la Maison du Tourisme
        </h1>

        <p class="text-slate-700 leading-relaxed mb-4">
            La Maison du Tourisme est une plateforme dédiée à la valorisation
            des sites touristiques, culturels et naturels. Elle a pour objectif
            de faciliter la découverte du patrimoine local et de promouvoir
            une offre touristique accessible, fiable et moderne.
        </p>

        <p class="text-slate-700 leading-relaxed mb-4">
            Elle s’adresse aussi bien aux visiteurs qu’aux acteurs du tourisme,
            en mettant en avant des lieux authentiques et des expériences
            uniques.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-10 text-center">
            <div>
                <p class="text-3xl font-bold text-blue-900">20+</p>
                <p class="text-sm text-slate-600">Sites référencés</p>
            </div>
            <div>
                <p class="text-3xl font-bold text-blue-900">10+</p>
                <p class="text-sm text-slate-600">Villes couvertes</p>
            </div>
            <div>
                <p class="text-3xl font-bold text-blue-900">100%</p>
                <p class="text-sm text-slate-600">Contenu vérifié</p>
            </div>
        </div>

    </section>

</main>

</body>
</html>
