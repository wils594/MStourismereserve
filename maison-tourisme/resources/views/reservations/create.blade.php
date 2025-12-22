<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réserver – {{ $site->titre }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 text-slate-900">

<main class="max-w-xl mx-auto px-4 py-10">

    <h1 class="text-2xl font-bold text-blue-900 mb-6">
        Réserver : {{ $site->titre }}
    </h1>

    <form method="POST" action="{{ route('reservation.store') }}"
          class="bg-white p-6 rounded-xl border space-y-4">
        @csrf

        <input type="hidden" name="site_id" value="{{ $site->id }}">

        <input name="nom_complet" placeholder="Nom complet"
               class="w-full border rounded px-4 py-2" required>

        <input name="pays_origine" placeholder="Pays d'origine"
               class="w-full border rounded px-4 py-2" required>

        <input name="langue" placeholder="Langue parlée"
               class="w-full border rounded px-4 py-2" required>

        <div class="grid grid-cols-2 gap-3">
            <input type="date" name="date_arrivee"
                   class="border rounded px-4 py-2" required>

            <input type="date" name="date_depart"
                   class="border rounded px-4 py-2" required>
        </div>

        <select name="type_groupe"
                class="w-full border rounded px-4 py-2">
            <option value="individuel">Individuel</option>
            <option value="groupe">Groupe</option>
        </select>

        <div class="grid grid-cols-2 gap-3">
            <input type="number" name="adultes" min="1"
                   placeholder="Adultes"
                   class="border rounded px-4 py-2" required>

            <input type="number" name="enfants" min="0"
                   placeholder="Enfants"
                   class="border rounded px-4 py-2">
        </div>

        <button class="w-full mt-4 py-2 rounded-full bg-blue-900 text-white font-semibold">
            Confirmer la réservation
        </button>

    </form>

</main>
</body>
</html>
