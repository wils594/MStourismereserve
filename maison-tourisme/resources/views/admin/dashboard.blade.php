<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Maison du Tourisme – Tableau de bord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-blue-900 text-slate-100 flex flex-col">

        <div class="px-6 py-5 border-b border-amber-400/40">
            <h1 class="text-lg font-bold tracking-wide">
                Maison du Tourisme
            </h1>
            <p class="text-xs text-amber-300 mt-1">
                Commune des Lacs 1 · Administration
            </p>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-2 text-sm">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-md bg-amber-400 text-blue-900 font-semibold">
                <span>Tableau de bord</span>
            </a>

            {{-- Sites --}}
            <a href="{{ route('admin.sites.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-blue-800 hover:text-amber-300 transition">
                <span>Sites touristiques</span>
            </a>

            <a href="#"
               class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-blue-800 hover:text-amber-300 transition">
                <span>Réservations</span>
            </a>

            <a href="#"
               class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-blue-800 hover:text-amber-300 transition">
                <span>Visiteurs</span>
            </a>

            <a href="#"
               class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-blue-800 hover:text-amber-300 transition">
                <span>Paramètres</span>
            </a>

        </nav>

        <div class="px-4 py-4 border-t border-blue-800 text-xs text-blue-200">
            Connecté en tant que<br>
            <span class="font-semibold text-white">
                {{ auth()->user()->name ?? 'Admin' }}
            </span>
        </div>
    </aside>

    {{-- CONTENU PRINCIPAL --}}
    <main class="flex-1 flex flex-col">

        {{-- TOPBAR --}}
        <header class="h-16 bg-white border-b border-blue-900/10 flex items-center justify-between px-6">
            <div>
                <h2 class="text-lg font-semibold text-blue-900">
                    Tableau de bord
                </h2>
                <p class="text-xs text-slate-500">
                    Commune des Lacs 1 · Gestion touristique
                </p>
            </div>

            <div class="flex items-center gap-3">
                <span class="text-sm text-slate-600">
                    {{ auth()->user()->email ?? '' }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="text-xs px-3 py-1.5 rounded-md bg-red-500 text-white hover:bg-red-600 transition">
                        Déconnexion
                    </button>
                </form>
            </div>
        </header>

        {{-- CONTENU --}}
        <section class="flex-1 p-6 space-y-6">

            {{-- STATS --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <div class="bg-white shadow-sm rounded-xl p-4">
                    <h3 class="text-xs font-semibold text-slate-500 uppercase">
                        Visiteurs inscrits
                    </h3>
                    <p class="mt-3 text-3xl font-bold text-emerald-700">
                        128
                    </p>
                    <p class="mt-1 text-xs text-emerald-600">
                        +8 cette semaine
                    </p>
                </div>

                <div class="bg-white shadow-sm rounded-xl p-4">
                    <h3 class="text-xs font-semibold text-slate-500 uppercase">
                        Réservations à venir
                    </h3>
                    <p class="mt-3 text-3xl font-bold text-blue-900">
                        37
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        Prochaines 30 jours
                    </p>
                </div>

                <div class="bg-white shadow-sm rounded-xl p-4">
                    <h3 class="text-xs font-semibold text-slate-500 uppercase">
                        Arrivées cette semaine
                    </h3>
                    <p class="mt-3 text-3xl font-bold text-amber-500">
                        12
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        Lundi → Dimanche
                    </p>
                </div>

                <div class="bg-white shadow-sm rounded-xl p-4">
                    <h3 class="text-xs font-semibold text-slate-500 uppercase">
                        Sites disponibles
                    </h3>
                    <p class="mt-3 text-3xl font-bold text-emerald-600">
                        {{ $publishedSites ?? 0 }}
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        Visibles en ligne
                    </p>
                </div>

            </div>

            {{-- TABLE --}}
            <div class="bg-white shadow-sm rounded-xl">
                <div class="p-6">

                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-semibold text-blue-900">
                            Prochaines arrivées
                        </h3>
                        <a href="#" class="text-xs text-amber-500 hover:underline">
                            Voir toutes les réservations
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-slate-50 border-b">
                                <tr class="text-xs text-slate-500 uppercase">
                                    <th class="px-2 py-2">Visiteur</th>
                                    <th class="px-2 py-2">Pays</th>
                                    <th class="px-2 py-2">Arrivée</th>
                                    <th class="px-2 py-2">Sites</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <tr>
                                    <td class="px-2 py-2">John Smith</td>
                                    <td class="px-2 py-2">États-Unis</td>
                                    <td class="px-2 py-2">15/01/2026</td>
                                    <td class="px-2 py-2">Plage d’Aného</td>
                                    <td class="px-2 py-2 text-right">
                                        <a href="#" class="text-xs text-blue-900 hover:underline">
                                            Détails
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-2">Maria Lopez</td>
                                    <td class="px-2 py-2">Espagne</td>
                                    <td class="px-2 py-2">18/01/2026</td>
                                    <td class="px-2 py-2">Lac Togo</td>
                                    <td class="px-2 py-2 text-right">
                                        <a href="#" class="text-xs text-blue-900 hover:underline">
                                            Détails
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            {{-- ACTIONS --}}
            <div class="bg-white shadow-sm rounded-xl">
                <div class="p-6">
                    <h3 class="text-base font-semibold text-blue-900 mb-3">
                        Actions rapides
                    </h3>

                    <div class="flex flex-wrap gap-3 text-sm">
                        <a href="{{ route('admin.sites.create') }}"
                           class="px-4 py-2 rounded-lg bg-amber-400 text-blue-900 font-semibold hover:bg-amber-500 transition">
                            Ajouter un site touristique
                        </a>

                        <a href="{{ route('admin.sites.index') }}"
                           class="px-4 py-2 rounded-lg bg-blue-50 text-blue-900 hover:bg-blue-100 transition">
                            Gérer les sites
                        </a>

                        <a href="#"
                           class="px-4 py-2 rounded-lg bg-blue-50 text-blue-900 hover:bg-blue-100 transition">
                            Gérer les réservations
                        </a>
                    </div>
                </div>
            </div>

        </section>
    </main>
</div>

</body>
</html>
