<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration – Maison du Tourisme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        body { background-color: #f4f7fb; }

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #0b2a5a, #0a1f44);
            color: #fff;
        }

        .sidebar .brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }

        .sidebar .brand span {
            font-size: .75rem;
            color: #ffc107;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,.85);
            border-radius: .5rem;
            padding: .65rem 1rem;
            display: flex;
            gap: .6rem;
            margin-bottom: .25rem;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: #ffc107;
            color: #0a1f44;
            font-weight: 600;
        }

        .topbar {
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #dee2e6;
        }

        .stat-card {
            border-radius: 1rem;
            border: none;
            box-shadow: 0 6px 18px rgba(0,0,0,.05);
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>

<div class="d-flex min-vh-100">

    <!-- SIDEBAR -->
    <aside class="sidebar d-flex flex-column">
        <div class="brand">
            <h5 class="fw-bold mb-0">Maison du Tourisme</h5>
            <span>Administration</span>
        </div>

        <nav class="flex-grow-1 p-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                <i class="bi bi-speedometer2"></i> Tableau de bord
            </a>
            <a href="{{ route('admin.reservations.index') }}" class="nav-link">
                <i class="bi bi-calendar-check"></i> Réservations
            </a>
            <a href="{{ route('admin.sites.index') }}" class="nav-link">
                <i class="bi bi-geo-alt"></i> Sites touristiques
            </a>
        </nav>

        <div class="p-3 small border-top border-white border-opacity-10">
            Connecté en tant que<br>
            <strong>{{ auth()->user()->name }}</strong>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="flex-grow-1 d-flex flex-column">

        <!-- TOPBAR -->
        <header class="topbar d-flex justify-content-between align-items-center px-4">
            <div>
                <h6 class="fw-semibold mb-0">Tableau de bord</h6>
                <small class="text-muted">Statistiques et activité récente</small>
            </div>

            <div class="d-flex gap-3 align-items-center">
                <span class="text-muted small">{{ auth()->user()->email }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-danger">Déconnexion</button>
                </form>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="p-4 flex-grow-1">

            <!-- STATS -->
            <div class="row g-4 mb-4">

                <div class="col-md-4">
                    <div class="card stat-card p-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">Visiteurs</small>
                                <h3 class="fw-bold text-success">{{ $visiteursCount }}</h3>
                            </div>
                            <div class="stat-icon bg-success">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card p-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">Arrivées</small>
                                <h3 class="fw-bold text-primary">{{ $totalArrivees }}</h3>
                            </div>
                            <div class="stat-icon bg-primary">
                                <i class="bi bi-arrow-down-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card p-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">Départs</small>
                                <h3 class="fw-bold text-warning">{{ $totalDeparts }}</h3>
                            </div>
                            <div class="stat-icon bg-warning">
                                <i class="bi bi-arrow-up-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- GRAPH -->
            <div class="card stat-card mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="fw-semibold mb-0">Arrivées & Départs par mois</h6>
                    <button class="btn btn-sm btn-warning fw-semibold" onclick="exportPDF()">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                    </button>
                </div>

                <div class="card-body">
                    <canvas id="fluxChart" height="120"></canvas>
                </div>
            </div>

            <!-- RÉSERVATIONS RÉCENTES -->
            <div class="card stat-card">
                <div class="card-header bg-white fw-semibold">
                    Réservations récentes
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Visiteur</th>
                                <th>Pays</th>
                                <th>Arrivée</th>
                                <th>Site</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservationsRecentes as $reservation)
                                <tr>
                                    <td class="fw-medium">{{ $reservation->nom_complet }}</td>
                                    <td>{{ $reservation->pays_origine }}</td>
                                    <td>{{ $reservation->date_arrivee->format('d/m/Y') }}</td>
                                    <td>{{ optional($reservation->site)->titre }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        Aucune réservation récente
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    new Chart(document.getElementById('fluxChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [
                {
                    label: 'Arrivées',
                    data: {!! json_encode($arriveesParMois) !!},
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13,110,253,.15)',
                    fill: true,
                    tension: .4
                },
                {
                    label: 'Départs',
                    data: {!! json_encode($departsParMois) !!},
                    borderColor: '#ffc107',
                    backgroundColor: 'rgba(255,193,7,.2)',
                    fill: true,
                    tension: .4
                }
            ]
        }
    });

    function exportPDF() {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();
        pdf.text("Statistiques – Maison du Tourisme", 20, 20);
        pdf.text("Visiteurs : {{ $visiteursCount }}", 20, 35);
        pdf.text("Arrivées : {{ $totalArrivees }}", 20, 45);
        pdf.text("Départs : {{ $totalDeparts }}", 20, 55);
        pdf.save("statistiques-tourisme.pdf");
    }
</script>

</body>
</html>
