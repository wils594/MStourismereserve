<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails réservation</title>
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

        .label {
            color: #6c757d;
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        .value {
            font-weight: 600;
            color: #212529;
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

<div class="container-fluid p-4">

    <!-- TITRE -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title mb-0">
            <i class="bi bi-file-text me-2"></i>
            Réservation – {{ $reservation->nom_complet }}
        </h1>

        <a href="{{ route('admin.reservations.index') }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Retour
        </a>
    </div>

    <!-- CARD DETAILS -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-6">
                    <div class="label">Site touristique</div>
                    <div class="value">
                        {{ optional($reservation->site)->titre }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="label">Pays d’origine</div>
                    <div class="value">
                        {{ $reservation->pays_origine }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="label">Langue</div>
                    <div class="value">
                        {{ $reservation->langue }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="label">Nombre de personnes</div>
                    <div class="value">
                        {{ $reservation->total_personnes }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="label">Date d’arrivée</div>
                    <div class="value">
                        {{ $reservation->date_arrivee->format('d/m/Y') }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="label">Date de départ</div>
                    <div class="value">
                        {{ optional($reservation->date_depart)?->format('d/m/Y') ?? '—' }}
                    </div>
                </div>

                <!-- STATUT -->
                <div class="col-md-12">
                    <div class="label">Statut</div>
                    <div class="value mt-1">
                        @if($reservation->statut === \App\Models\Reservation::STATUT_EN_ATTENTE)
                            <span class="badge badge-waiting">En attente</span>
                        @elseif($reservation->statut === \App\Models\Reservation::STATUT_VALIDEE)
                            <span class="badge badge-valid">Validée</span>
                        @else
                            <span class="badge badge-refused">Refusée</span>
                        @endif
                    </div>
                </div>

            </div>

            <!-- MOTIF DE REFUS (SEULEMENT SI REFUSÉE) -->
            @if(
                $reservation->statut === \App\Models\Reservation::STATUT_REFUSEE
                && $reservation->motif_refus
            )
                <div class="alert alert-danger mt-4">
                    <strong>Motif du refus :</strong><br>
                    {{ $reservation->motif_refus }}
                </div>
            @endif

            <!-- ACTIONS (SEULEMENT SI EN ATTENTE) -->
            @if($reservation->statut === \App\Models\Reservation::STATUT_EN_ATTENTE)
                <div class="d-flex gap-3 mt-4 pt-3 border-top">

                    <!-- VALIDER -->
                    <form method="POST"
                          action="{{ route('admin.reservations.valider', $reservation) }}">
                        @csrf
                        <button class="btn btn-success">
                            <i class="bi bi-check-circle"></i>
                            Valider
                        </button>
                    </form>

                    <!-- REFUSER -->
                    <button class="btn btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#refuseModal">
                        <i class="bi bi-x-circle"></i>
                        Refuser
                    </button>

                </div>
            @endif

        </div>
    </div>

</div>

<!-- MODAL REFUS -->
<div class="modal fade" id="refuseModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST"
              action="{{ route('admin.reservations.refuser', $reservation) }}"
              class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    Motif du refus
                </h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">
                        Expliquez pourquoi la réservation est refusée
                    </label>
                    <textarea name="motif_refus"
                              class="form-control"
                              rows="4"
                              required
                              placeholder="Ex : indisponibilité du site, date non disponible, nombre de personnes trop élevé..."></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                    Annuler
                </button>
                <button type="submit"
                        class="btn btn-danger">
                    Confirmer le refus
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
