<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon espace client – Maison du Tourisme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f7fb;
        }

        .page-title {
            color: #0b2a5a;
            font-weight: 700;
        }

        .reservation-card {
            border-radius: 1rem;
        }

        .badge-waiting {
            background-color: #ffc107;
            color: #0b2a5a;
        }

        .badge-valid {
            background-color: #198754;
        }

        .badge-refused {
            background-color: #dc3545;
        }
    </style>
</head>

<body>

<main class="container py-5">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="page-title mb-0">
            <i class="bi bi-person-circle me-2"></i>
            Mon tableau de bord
        </h1>

        <a href="{{ route('accueil') }}"
           class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i>
            Retour à l’accueil
        </a>
    </div>

    <!-- MESSAGE SUCCESS -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- SECTION RÉSERVATIONS -->
    <section>

        <h2 class="h4 fw-semibold mb-4">
            Mes réservations
        </h2>

        @forelse($reservations as $reservation)

            <div class="card reservation-card shadow-sm border-0 mb-4">
                <div class="card-body">

                    <!-- HEADER CARD -->
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="fw-semibold mb-0">
                            {{ optional($reservation->site)->titre }}
                        </h5>

                        @switch($reservation->statut)
                            @case(\App\Models\Reservation::STATUT_EN_ATTENTE)
                                <span class="badge badge-waiting">
                                    En attente
                                </span>
                                @break

                            @case(\App\Models\Reservation::STATUT_VALIDEE)
                                <span class="badge badge-valid">
                                    Validée
                                </span>
                                @break

                            @case(\App\Models\Reservation::STATUT_REFUSEE)
                                <span class="badge badge-refused">
                                    Refusée
                                </span>
                                @break
                        @endswitch
                    </div>

                    <!-- INFOS -->
                    <p class="text-muted small mb-1">
                        <i class="bi bi-geo-alt"></i>
                        {{ optional($reservation->site)->ville }}
                    </p>

                    <p class="mb-1">
                        <i class="bi bi-calendar-event"></i>
                        Du <strong>{{ $reservation->date_arrivee->format('d/m/Y') }}</strong>
                        au <strong>{{ optional($reservation->date_depart)?->format('d/m/Y') ?? '—' }}</strong>
                        — {{ $reservation->nombre_jours }} jour(s)
                    </p>

                    <p class="mb-2">
                        <i class="bi bi-people"></i>
                        {{ $reservation->total_personnes }} personne(s)
                        ({{ $reservation->adultes }} adulte(s),
                        {{ $reservation->enfants }} enfant(s))
                    </p>

                    <!-- MOTIF DE REFUS -->
                    @if(
                        $reservation->statut === \App\Models\Reservation::STATUT_REFUSEE
                        && $reservation->motif_refus
                    )
                        <div class="alert alert-danger mt-3 mb-0">
                            <strong>Motif du refus :</strong><br>
                            {{ $reservation->motif_refus }}
                        </div>
                    @endif

                    <!-- ACTION -->
                    @if($reservation->statut === \App\Models\Reservation::STATUT_EN_ATTENTE)
                        <a href="{{ route('reservation.edit', $reservation) }}"
                           class="btn btn-sm btn-outline-primary mt-3">
                            <i class="bi bi-pencil-square"></i>
                            Modifier la réservation
                        </a>
                    @endif

                </div>
            </div>

        @empty
            <p class="text-muted">
                Vous n’avez encore effectué aucune réservation.
            </p>
        @endforelse

    </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
