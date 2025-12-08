<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des sites touristiques – Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #0f172a;
            color: #0f172a;
            min-height: 100vh;
        }

        .page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.8rem 1.5rem 2.5rem;
        }

        .page-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #f9fafb;
            margin-bottom: 0.4rem;
        }

        .page-subtitle {
            font-size: .85rem;
            color: #cbd5f5;
            margin-bottom: 1.4rem;
        }

        .card {
            background: #f9fafb;
            border-radius: 1.1rem;
            padding: 1.4rem 1.3rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.45);
            border: 1px solid rgba(148, 163, 184, 0.6);
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .top-bar-left {
            font-size: .9rem;
            color: #4b5563;
        }

        .btn-primary {
            border: none;
            border-radius: 999px;
            padding: 0.55rem 1.3rem;
            font-size: .85rem;
            font-weight: 600;
            color: #f9fafb;
            background: linear-gradient(90deg, #4f46e5, #0ea5e9);
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.5);
            transition: .18s ease;
        }

        .btn-primary:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
        }

        .alert {
            margin-bottom: 1rem;
            padding: 0.6rem 0.9rem;
            border-radius: 0.6rem;
            font-size: 0.8rem;
            color: #065f46;
            background: #d1fae5;
            border: 1px solid #6ee7b7;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: .8rem;
            margin-top: 0.5rem;
        }

        thead {
            background: #e5e7eb;
        }

        th, td {
            padding: 0.55rem 0.4rem;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        th {
            text-align: left;
            font-weight: 600;
            color: #4b5563;
            font-size: .78rem;
        }

        tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 0.15rem 0.5rem;
            border-radius: 999px;
            font-size: 0.7rem;
        }

        .badge-on {
            background: #dcfce7;
            color: #166534;
        }

        .badge-off {
            background: #fee2e2;
            color: #991b1b;
        }

        .actions {
            display: flex;
            gap: 0.4rem;
        }

        .btn-sm {
            border-radius: 999px;
            border: none;
            padding: 0.3rem 0.7rem;
            font-size: .72rem;
            cursor: pointer;
        }

        .btn-edit {
            background: #e0f2fe;
            color: #1d4ed8;
        }

        .btn-delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        .img-thumb {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
        }

        @media (max-width: 800px) {
            .page {
                padding-inline: 1rem;
            }

            table {
                font-size: 0.75rem;
            }

            .top-bar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

<div class="page">
    <div class="page-title">Gestion des sites touristiques</div>
    <div class="page-subtitle">
        Créez, modifiez et publiez les sites visibles par les visiteurs.
    </div>

    <div class="card">

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        {{-- Barre haute : compteur + bouton --}}
        <div class="top-bar">
            <div class="top-bar-left">
                @if($sites->count())
                    {{ $sites->count() }} site(s) enregistré(s)
                @else
                    Aucun site enregistré pour le moment.
                @endif
            </div>

            <a href="{{ route('admin.sites.create') }}">
                <button type="button" class="btn-primary">
                    + Ajouter un site
                </button>
            </a>
        </div>

        {{-- Tableau des sites --}}
        @if($sites->count())
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Ville</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Statut</th>
                        <th>Créé le</th>
                        <th style="width: 130px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sites as $site)
                        <tr>
                            <td>{{ $site->id }}</td>
                            <td>{{ $site->titre }}</td>
                            <td>{{ $site->ville }}</td>
                            <td>
                                {{ \Illuminate\Support\Str::limit($site->description, 80) }}
                            </td>
                            <td>
                               @if($site->image_url)
    <img src="{{ asset('storage/' . $site->image_url) }}"
         class="w-20 h-12 object-cover rounded border">
@endif

                            </td>
                            <td>
                                @if($site->is_publishing)
                                    <span class="badge badge-on">Publié</span>
                                @else
                                    <span class="badge badge-off">Masqué</span>
                                @endif
                            </td>
                            <td>{{ $site->created_at?->format('d/m/Y') }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.sites.edit', $site) }}">
                                        <button type="button" class="btn-sm btn-edit">
                                            Modifier
                                        </button>
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.sites.destroy', $site) }}"
                                          onsubmit="return confirm('Supprimer ce site ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-delete">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
</div>

</body>
</html>
