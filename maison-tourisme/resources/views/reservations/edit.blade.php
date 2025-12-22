<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la réservation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 text-slate-900">

<main class="max-w-2xl mx-auto px-4 py-10">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-blue-900">
            Modifier la réservation
        </h1>

        <a href="{{ route('reservations.index') }}"
           class="text-sm font-semibold text-blue-900 hover:underline">
            ← Retour
        </a>
    </div>

    <!-- SITE -->
    <div class="mb-6 p-4 bg-white rounded-xl border shadow-sm">
        <h2 class="font-semibold text-lg">
            {{ $reservation->site->titre }}
        </h2>
        <p class="text-sm text-slate-600">
            📍 {{ $reservation->site->ville }}
        </p>
    </div>

    <!-- FORMULAIRE -->
    <form method="POST" action="{{ route('reservation.update', $reservation) }}"
          class="bg-white p-6 rounded-xl border shadow-sm space-y-4">
        @csrf
        @method('PUT')

        <!-- NOM -->
        <div>
            <label class="text-sm font-semibold">Nom complet</label>
            <input type="text" name="nom_complet"
                   value="{{ old('nom_complet', $reservation->nom_complet) }}"
                   class="w-full rounded border px-4 py-2 text-sm" required>
        </div>

        <!-- DATES -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-semibold">Date d’arrivée</label>
                <input type="date" name="date_arrivee"
                       value="{{ $reservation->date_arrivee->format('Y-m-d') }}"
                       class="w-full rounded border px-4 py-2 text-sm" required>
            </div>

            <div>
                <label class="text-sm font-semibold">Date de départ</label>
                <input type="date" name="date_depart"
                       value="{{ $reservation->date_depart->format('Y-m-d') }}"
                       class="w-full rounded border px-4 py-2 text-sm" required>
            </div>
        </div>

        <!-- PERSONNES -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-semibold">Adultes</label>
                <input type="number" name="adultes"
                       value="{{ $reservation->adultes }}"
                       class="w-full rounded border px-4 py-2 text-sm" min="1">
            </div>

            <div>
                <label class="text-sm font-semibold">Enfants</label>
                <input type="number" name="enfants"
                       value="{{ $reservation->enfants }}"
                       class="w-full rounded border px-4 py-2 text-sm" min="0">
            </div>
        </div>

        <!-- ACTION -->
        <div class="flex justify-end pt-4">
            <button class="px-6 py-2 rounded-full bg-blue-900 text-white text-sm font-semibold">
                Enregistrer les modifications
            </button>
        </div>

    </form>

</main>

</body>
</html>
