<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Maison du Tourisme – Tableau de bord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- Tailwind via CDN (pour aller vite) --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-slate-100 flex flex-col">
            <div class="px-6 py-5 border-b border-slate-800">
                <h1 class="text-lg font-bold">Maison du Tourisme</h1>
                <p class="text-xs text-slate-400 mt-1">Backoffice d'administration</p>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-2 text-sm">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-md bg-slate-800">
                    <span>Tableau de bord</span>
                </a>

                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800">
                    <span>Sites touristiques</span>
                </a>

                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800">
                    <span>Réservations</span>
                </a>

                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800">
                    <span>Visiteurs</span>
                </a>

                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-slate-800">
                    <span>Paramètres</span>
                </a>
            </nav>

            <div class="px-4 py-4 border-t border-slate-800 text-xs text-slate-400">
                Connecté en tant que<br>
                <span class="font-semibold text-slate-200">{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
        </aside>

        {{-- Contenu principal --}}
        <main class="flex-1 flex flex-col">

            {{-- Topbar --}}
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6">
                <div>
                    <h2 class="text-lg font-semibold text-slate-800">
                        Tableau de bord
                    </h2>
                    <p class="text-xs text-slate-500">
                        Vue d’ensemble des activités et réservations
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
                            class="text-xs px-3 py-1.5 rounded-md bg-red-500 text-white hover:bg-red-600"
                        >
                            Déconnexion
                        </button>
                    </form>
                </div>
            </header>

            {{-- Contenu --}}
            <section class="flex-1 p-6 space-y-6">

                {{-- Cartes de statistiques --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white shadow-sm rounded-xl p-4">
                        <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                            Visiteurs inscrits
                        </h3>
                        <p class="mt-3 text-3xl font-bold text-slate-900">
                            128
                            {{-- Plus tard: {{ $totalVisitors }} --}}
                        </p>
                        <p class="mt-1 text-xs text-emerald-600">
                            +8 cette semaine
                        </p>
                    </div>

                    <div class="bg-white shadow-sm rounded-xl p-4">
                        <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                            Réservations à venir
                        </h3>
                        <p class="mt-3 text-3xl font-bold text-slate-900">
                            37
                            {{-- {{ $upcomingReservationsCount }} --}}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            Prochaines 30 jours
                        </p>
                    </div>

                    <div class="bg-white shadow-sm rounded-xl p-4">
                        <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                            Arrivées cette semaine
                        </h3>
                        <p class="mt-3 text-3xl font-bold text-slate-900">
                            12
                            {{-- {{ $arrivalsThisWeek }} --}}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            Lundi &rarr; Dimanche
                        </p>
                    </div>

                    <div class="bg-white shadow-sm rounded-xl p-4">
                        <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                            Sites disponibles
                        </h3>
                        <p class="mt-3 text-3xl font-bold text-slate-900">
                            9
                            {{-- {{ $activeSites }} --}}
                        </p>
                        <p class="mt-1 text-xs text-slate-500">
                            Activés et visibles en ligne
                        </p>
                    </div>
                </div>

                {{-- Prochaines arrivées --}}
                <div class="bg-white shadow-sm rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base font-semibold text-slate-800">
                                Prochaines arrivées
                            </h3>
                            <a href="#" class="text-xs text-indigo-600 hover:underline">
                                Voir toutes les réservations
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm">
                                <thead class="border-b border-slate-200 bg-slate-50">
                                    <tr class="text-xs text-slate-500 uppercase">
                                        <th class="py-2 px-2">Visiteur</th>
                                        <th class="py-2 px-2">Pays</th>
                                        <th class="py-2 px-2">Date d'arrivée</th>
                                        <th class="py-2 px-2">Sites réservés</th>
                                        <th class="py-2 px-2"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    {{-- Exemple statique, à remplacer par une boucle --}}
                                    <tr>
                                        <td class="py-2 px-2">John Smith</td>
                                        <td class="py-2 px-2">États-Unis</td>
                                        <td class="py-2 px-2">15/01/2026</td>
                                        <td class="py-2 px-2">Plage d’Aného, Togoville</td>
                                        <td class="py-2 px-2 text-right">
                                            <a href="#" class="text-xs text-indigo-600 hover:underline">
                                                Détails
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-2">Maria Lopez</td>
                                        <td class="py-2 px-2">Espagne</td>
                                        <td class="py-2 px-2">18/01/2026</td>
                                        <td class="py-2 px-2">Lac Togo</td>
                                        <td class="py-2 px-2 text-right">
                                            <a href="#" class="text-xs text-indigo-600 hover:underline">
                                                Détails
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                {{-- Actions rapides --}}
                <div class="bg-white shadow-sm rounded-xl">
                    <div class="p-6">
                        <h3 class="text-base font-semibold text-slate-800 mb-3">
                            Actions rapides
                        </h3>

                        <div class="flex flex-wrap gap-3 text-sm">
                            <a href="#"
                               class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                Ajouter un site touristique
                            </a>
                            <a href="#"
                               class="px-4 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200">
                                Gérer les réservations
                            </a>
                            <a href="#"
                               class="px-4 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200">
                                Gérer les visiteurs
                            </a>
                        </div>
                    </div>
                </div>

            </section>
        </main>

    </div>

</body>
</html>
