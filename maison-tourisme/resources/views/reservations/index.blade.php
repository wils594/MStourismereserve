<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes réservations – Maison du Tourisme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 text-slate-900">

<main class="max-w-4xl mx-auto px-4 py-10">

    <!-- TITRE -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-blue-900">
            Mes réservations
        </h1>

        <a href="{{ route('accueil') }}"
           class="text-sm font-semibold text-blue-900 hover:underline">
            ← Retour à l’accueil
        </a>
    </div>

    <!-- MESSAGE SUCCESS -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- LISTE DES RÉSERVATIONS -->
    @forelse($reservations as $reservation)

        <div class="bg-white border rounded-xl p-5 mb-4 shadow-sm">

            <div class="flex justify-between items-start mb-2">
                <h2 class="font-semibold text-lg">
                    {{ $reservation->site->titre }}
                </h2>

                <!-- STATUT -->
                @switch($reservation->statut)
                    @case(\App\Models\Reservation::STATUT_EN_ATTENTE)
                        <span class="text-xs px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                            En attente
                        </span>
                        @break

                    @case(\App\Models\Reservation::STATUT_VALIDEE)
                        <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700">
                            Validée
                        </span>
                        @break

                    @case(\App\Models\Reservation::STATUT_REFUSEE)
                        <span class="text-xs px-3 py-1 rounded-full bg-red-100 text-red-700">
                            Refusée
                        </span>
                        @break
                @endswitch
            </div>

            <p class="text-sm text-slate-600 mb-2">
                📍 {{ $reservation->site->ville }}
            </p>

            <p class="text-sm">
                🗓 Du
                <strong>{{ $reservation->date_arrivee->format('d/m/Y') }}</strong>
                au
                <strong>{{ $reservation->date_depart->format('d/m/Y') }}</strong>
                — {{ $reservation->nombre_jours }} jours
            </p>

            <p class="text-sm mt-2">
                👥 {{ $reservation->total_personnes }} personne(s)
                ({{ $reservation->adultes }} adulte(s),
                {{ $reservation->enfants }} enfant(s))
            </p>

            <!-- ACTIONS -->
            @if($reservation->statut === \App\Models\Reservation::STATUT_EN_ATTENTE)
                <a href="{{ route('reservation.edit', $reservation) }}"
                   class="inline-block mt-3 text-sm font-semibold text-blue-900 hover:underline">
                    ✏️ Modifier la réservation
                </a>
            @endif

        </div>

    @empty
        <p class="text-center text-slate-500">
            Vous n’avez encore effectué aucune réservation.
        </p>
    @endforelse

</main>

</body>
</html>
