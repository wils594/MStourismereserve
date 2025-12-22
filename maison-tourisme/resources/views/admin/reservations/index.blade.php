<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservations – Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
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

        .card {
            border-radius: 1rem;
        }

        .table thead {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

<div class="container-fluid p-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">
                <i class="bi bi-calendar-check me-2"></i>
                Toutes les réservations
            </h1>
            <p class="text-muted mb-0">
                Gestion et suivi des réservations des visiteurs
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-outline-primary">
            <i class="bi bi-arrow-left-circle me-1"></i>
            Retour au dashboard
        </a>
    </div>

    <!-- MESSAGE SUCCESS -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead>
                <tr class="text-uppercase small text-muted">
                    <th>Visiteur</th>
                    <th>Pays</th>
                    <th>Site</th>
                    <th>Arrivée</th>
                    <th>Personnes</th>
                    <th>Statut</th>
                    <th class="text-end">Action</th>
                </tr>
                </thead>

                <tbody>
                @forelse($reservations as $reservation)
                    <tr>
                        <td class="fw-semibold">
                            {{ $reservation->nom_complet }}
                        </td>

                        <td>
                            {{ $reservation->pays_origine }}
                        </td>

                        <td>
                            {{ optional($reservation->site)->titre }}
                        </td>

                        <td>
                            {{ $reservation->date_arrivee->format('d/m/Y') }}
                        </td>

                        <td>
                            {{ $reservation->total_personnes }}
                        </td>

                        <td>
                            @if($reservation->statut === \App\Models\Reservation::STATUT_EN_ATTENTE)
                                <span class="badge badge-waiting">
                                    En attente
                                </span>
                            @elseif($reservation->statut === \App\Models\Reservation::STATUT_VALIDEE)
                                <span class="badge badge-valid">
                                    Validée
                                </span>
                            @else
                                <span class="badge badge-refused">
                                    Refusée
                                </span>
                            @endif
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.reservations.show', $reservation) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                                Détails
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Aucune réservation trouvée
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <!-- PAGINATION -->
    <div class="d-flex justify-content-end mt-4">
        {{ $reservations->links('pagination::bootstrap-5') }}
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
