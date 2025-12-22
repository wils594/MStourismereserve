<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Paramètres – Maison du Tourisme</title>
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
            <a href="{{ route('admin.visitors.index') }}" class="block px-3 py-2 rounded hover:bg-blue-800">Visiteurs</a>
            <a href="{{ route('admin.settings') }}" class="block px-3 py-2 rounded bg-amber-400 text-blue-900 font-semibold">
                Paramètres
            </a>
        </nav>
    </aside>

    {{-- CONTENU --}}
    <main class="flex-1 p-6 space-y-6">

        <h2 class="text-xl font-semibold text-blue-900">Paramètres généraux</h2>

        <div class="bg-white rounded-xl shadow-sm p-6 space-y-4 max-w-xl">

            <div>
                <label class="text-sm font-medium text-slate-700">Nom de l’administrateur</label>
                <input type="text"
                       value="{{ auth()->user()->name }}"
                       disabled
                       class="mt-1 w-full rounded border-slate-300 bg-slate-100 text-sm">
            </div>

            <div>
                <label class="text-sm font-medium text-slate-700">Email</label>
                <input type="email"
                       value="{{ auth()->user()->email }}"
                       disabled
                       class="mt-1 w-full rounded border-slate-300 bg-slate-100 text-sm">
            </div>

            <div class="pt-4 border-t text-xs text-slate-500">
                Ces paramètres seront étendus (notifications, rôles, sécurité).
            </div>

        </div>

    </main>
</div>

</body>
</html>
