<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Visiteurs – Maison du Tourisme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-blue-900 text-slate-100 flex flex-col">
        <div class="px-6 py-5 border-b border-amber-400/40">
            <h1 class="text-lg font-bold">Maison du Tourisme</h1>
            <p class="text-xs text-amber-300">Administration</p>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-2 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-blue-800">Tableau de bord</a>
            <a href="{{ route('admin.sites.index') }}" class="block px-3 py-2 rounded hover:bg-blue-800">Sites touristiques</a>
            <a href="{{ route('admin.visitors.index') }}" class="block px-3 py-2 rounded bg-amber-400 text-blue-900 font-semibold">
                Visiteurs
            </a>
            <a href="{{ route('admin.settings') }}" class="block px-3 py-2 rounded hover:bg-blue-800">Paramètres</a>
        </nav>

        <div class="px-4 py-4 border-t border-blue-800 text-xs">
            {{ auth()->user()->name }}
        </div>
    </aside>

    {{-- CONTENU --}}
    <main class="flex-1 p-6 space-y-6">

        <h2 class="text-xl font-semibold text-blue-900">Liste des visiteurs</h2>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 border-b">
                    <tr class="text-xs uppercase text-slate-500">
                        <th class="px-4 py-2 text-left">Nom</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2">Inscrit le</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($visitors as $user)
                        <tr>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-center">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center text-slate-500">
                                Aucun visiteur enregistré
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
</div>

</body>
</html>
