<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un site touristique – Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tu peux réutiliser exactement le même <style> que pour create --}}
    <style>
        /* Pour aller vite, tu peux copier-coller le style de create.blade.php ici */
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
            font-size: 1.3rem;
            font-weight: 700;
            color: #f9fafb;
            margin-bottom: 1rem;
        }

        .card {
            background: #f9fafb;
            border-radius: 1.1rem;
            padding: 1.6rem 1.4rem;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.45);
            border: 1px solid rgba(148, 163, 184, 0.6);
        }

        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            flex: 1;
        }

        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 0.25rem;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 0.5rem 0.6rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            font-size: 0.85rem;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-footer {
            margin-top: 1.3rem;
            display: flex;
            gap: 0.6rem;
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
        }

        .btn-secondary {
            border-radius: 999px;
            padding: 0.5rem 1.1rem;
            font-size: .8rem;
            border: 1px solid #d1d5db;
            background: #e5e7eb;
            color: #111827;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: 0.3rem;
            font-size: 0.8rem;
            color: #4b5563;
        }

        .error {
            font-size: 0.75rem;
            color: #b91c1c;
            margin-top: 0.2rem;
        }

        @media (max-width: 800px) {
            .page {
                padding-inline: 1rem;
            }

            .form-row {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<div class="page">
    <div class="page-title">Modifier le site : {{ $site->titre }}</div>

    <div class="card">

        <form method="POST" action="{{ route('admin.sites.update', $site) }}">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="titre">Titre du site *</label>
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

            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="img_url">Image (URL)</label>
                <input type="text" id="img_url" name="img_url"
                       value="{{ old('img_url', $site->img_url) }}">
                @error('img_url')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="description">Description</label>
                <textarea id="description" name="description">{{ old('description', $site->description) }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
    <label class="block text-sm font-medium mb-1">Changer l’image :</label>
    <input type="file" name="image" accept="image/*"
           class="w-full border rounded px-3 py-2 bg-white">
</div>

@if($site->image_url)
    <p class="text-sm text-slate-600 mt-1">Image actuelle :</p>
    <img src="{{ asset('storage/' . $site->image_url) }}" class="w-32 h-20 object-cover rounded mt-1">
@endif


            <div class="checkbox-row">
                <input type="checkbox" id="is_publishing" name="is_publishing" value="1"
                    {{ old('is_publishing', $site->is_publishing) ? 'checked' : '' }}>
                <label for="is_publishing" style="margin: 0;">Site publié (visible par les visiteurs)</label>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-primary">Mettre à jour</button>

                <a href="{{ route('admin.sites.index') }}" class="btn-secondary">
                    Annuler
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>
