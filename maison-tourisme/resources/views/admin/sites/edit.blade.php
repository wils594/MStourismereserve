<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un site touristique – Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f8fafc;
            color: #0f172a;
            min-height: 100vh;
        }

        .page {
            max-width: 820px;
            margin: 0 auto;
            padding: 1.5rem 1rem;
        }

        .page-title {
            font-size: 1.1rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.9rem;
        }

        .card {
            background: #ffffff;
            border-radius: 0.75rem;
            padding: 1.25rem 1.2rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.06);
        }

        .form-row {
            display: flex;
            gap: 0.8rem;
            margin-bottom: 0.8rem;
        }

        .form-group {
            flex: 1;
        }

        label {
            display: block;
            text-align: center;
            font-size: 0.7rem;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 0.2rem;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 0.45rem 0.55rem;
            border-radius: 0.4rem;
            border: 1px solid #cbd5e1;
            font-size: 0.78rem;
            background: #ffffff;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        .checkbox-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.4rem;
            margin-top: 0.6rem;
            font-size: 0.72rem;
            color: #475569;
        }

        .form-footer {
            margin-top: 1.2rem;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            border: none;
            border-radius: 999px;
            padding: 0.4rem 1.2rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: #ffffff;
            background: #2563eb;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            border-radius: 999px;
            padding: 0.4rem 1.1rem;
            font-size: 0.7rem;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            color: #0f172a;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .error {
            font-size: 0.65rem;
            color: #b91c1c;
            margin-top: 0.15rem;
            text-align: center;
        }

        @media (max-width: 700px) {
            .form-row {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="page-title">
        Modifier le site : {{ $site->titre }}
    </div>

    <div class="card">

        <form method="POST" action="{{ route('admin.sites.update', $site) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="titre">Titre du site</label>
                    <input type="text" id="titre" name="titre"
                           value="{{ old('titre', $site->titre) }}" required>
                    @error('titre')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ville">Ville / Localisation</label>
                    <input type="text" id="ville" name="ville"
                           value="{{ old('ville', $site->ville) }}">
                    @error('ville')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0.8rem;">
                <label for="image">Changer l’image</label>
                <input type="file" name="image" accept="image/*">
            </div>

            @if($site->image_url)
                <div style="text-align:center; margin-bottom:0.8rem;">
                    <label>Image actuelle</label>
                    <img src="{{ asset('storage/' . $site->image_url) }}"
                         class="w-28 h-18 object-cover rounded"
                         alt="Image actuelle">
                </div>
            @endif

            <div class="form-group" style="margin-bottom: 0.8rem;">
                <label for="description">Description</label>
                <textarea id="description" name="description">{{ old('description', $site->description) }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="checkbox-row">
                <input type="checkbox" id="is_publishing" name="is_publishing" value="1"
                    {{ old('is_publishing', $site->is_publishing) ? 'checked' : '' }}>
                <label for="is_publishing" style="margin:0;">
                    Site publié
                </label>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-primary">
                    Mettre à jour
                </button>

                <a href="{{ route('admin.sites.index') }}" class="btn-secondary">
                    Annuler
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>
