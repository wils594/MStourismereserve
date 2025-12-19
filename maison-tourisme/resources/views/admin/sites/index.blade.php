<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Gestion des sites touristiques – Maison du Tourisme</title>
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

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-blue-800 hover:text-amber-300 transition">
                <span>Tableau de bord</span>
            </a>

            <a href="{{ route('admin.sites.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-md bg-amber-400 text-blue-900 font-semibold">
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
                    Gestion des sites touristiques
                </h2>
                <p class="text-xs text-slate-500">
                    Créez, publiez et organisez les sites visibles par les visiteurs.
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
        <section class="flex-1 p-6 space-y-4">

            {{-- Message succès --}}
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm px-4 py-2 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Bandeau haut --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <p class="text-sm text-slate-600">
                        @if($sites->count())
                            <span class="font-semibold">{{ $sites->count() }}</span> site(s) enregistré(s)
                        @else
                            Aucun site enregistré pour le moment.
                        @endif
                    </p>
                    @if($sites->count())
                        <p class="text-xs text-slate-500 mt-1">
                            Gérez le statut, les images et les informations de chaque site.
                        </p>
                    @endif
                </div>

                <a href="{{ route('admin.sites.create') }}"
                   class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                          bg-amber-400 text-blue-900 hover:bg-amber-500 shadow transition">
                    + Ajouter un site touristique
                </a>
            </div>

            {{-- État vide --}}
            @if(!$sites->count())
                <div class="mt-4 bg-white rounded-xl border border-dashed border-slate-300 p-8 text-center text-sm text-slate-500">
                    <p>Aucun site touristique n’a encore été créé.</p>
                    <p class="mt-1">
                        Commencez par ajouter un premier site pour qu’il apparaisse sur la page d’accueil.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('admin.sites.create') }}"
                           class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                                  bg-amber-400 text-blue-900 hover:bg-amber-500 shadow transition">
                            + Créer mon premier site
                        </a>
                    </div>
                </div>
            @else
                {{-- TABLE --}}
                <div class="bg-white shadow-sm rounded-xl overflow-hidden">

                    <div class="px-4 py-3 border-b border-slate-200 flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-blue-900">
                            Liste des sites touristiques
                        </h3>
                        <span class="text-xs text-slate-500">
                            Cliquez sur “Modifier” pour mettre à jour un site.
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-slate-50 border-b border-slate-200">
                                <tr class="text-xs uppercase text-slate-500">
                                    <th class="py-2 px-3 text-left">#</th>
                                    <th class="py-2 px-3 text-left">Site</th>
                                    <th class="py-2 px-3 text-left">Ville</th>
                                    <th class="py-2 px-3 text-left">Description</th>
                                    <th class="py-2 px-3 text-left">Image</th>
                                    <th class="py-2 px-3 text-left">Statut</th>
                                    <th class="py-2 px-3 text-left">Créé le</th>
                                    <th class="py-2 px-3 text-right">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @foreach($sites as $site)
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-2 px-3 text-slate-500">{{ $site->id }}</td>

                                        <td class="py-2 px-3 font-medium text-slate-800">
                                            {{ $site->titre }}
                                        </td>

                                        <td class="py-2 px-3 text-slate-600">
                                            {{ $site->ville }}
                                        </td>

                                        <td class="py-2 px-3 text-slate-600 max-w-xs">
                                            {{ \Illuminate\Support\Str::limit($site->description, 80) }}
                                        </td>

                                        <td class="py-2 px-3">
                                            @if($site->image_url)
                                                <img src="{{ asset('storage/' . $site->image_url) }}"
                                                     class="w-20 h-12 object-cover rounded-md border border-slate-200">
                                            @else
                                                <span class="text-xs text-slate-400">Aucune</span>
                                            @endif
                                        </td>

                                        <td class="py-2 px-3">
                                            @if($site->is_publishing)
                                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs
                                                             bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    Publié
                                                </span>
                                            @else
                                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs
                                                             bg-rose-50 text-rose-700 border border-rose-200">
                                                    Masqué
                                                </span>
                                            @endif
                                        </td>

                                        <td class="py-2 px-3 text-slate-600">
                                            {{ $site->created_at?->format('d/m/Y') }}
                                        </td>

                                        <td class="py-2 px-3 text-right">
                                            <div class="inline-flex gap-2">
                                                <a href="{{ route('admin.sites.edit', $site) }}"
                                                   class="px-3 py-1 rounded-full text-xs
                                                          bg-blue-50 text-blue-900 hover:bg-blue-100 transition">
                                                    Modifier
                                                </a>

                                                <form method="POST"
                                                      action="{{ route('admin.sites.destroy', $site) }}"
                                                      onsubmit="return confirm('Supprimer ce site ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="px-3 py-1 rounded-full text-xs
                                                                   bg-rose-100 text-rose-700 hover:bg-rose-200 transition">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            @endif

        </section>
    </main>
</div>

</body>
</html>
