<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sites; // ou App\Models\Site si modèle au singulier
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class SitesController extends Controller
{
    /**
     * Liste des sites.
     */
    public function index(): View
    {
        $sites = Sites::orderBy('created_at', 'desc')->get();

        return view('admin.sites.index', compact('sites'));
    }

    /**
     * Formulaire de création.
     */
    public function create(): View
    {
        return view('admin.sites.create');
    }

    /**
     * Enregistrement d'un nouveau site.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validation des champs texte
        $data = $request->validate([
            'titre'        => ['required', 'string', 'max:255'],
            'ville'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'is_publishing'=> ['nullable'],
        ]);

        // 2. Upload de l'image (OPTIONNEL)
        if ($request->hasFile('image')) {
            // Stocke le fichier dans storage/app/public/sites
            $path = $request->file('image')->store('sites', 'public');

            // On enregistre le chemin dans la colonne image_url
            $data['image_url'] = $path;
        }

        // 3. Checkbox publication
        $data['is_publishing'] = $request->has('is_publishing');

        // 4. Création en base
        Sites::create($data);

        return redirect()
            ->route('admin.sites.index')
            ->with('success', 'Le site a été créé avec succès.');
    }

    /**
     * Formulaire d’édition.
     */
    public function edit(Sites $site): View
    {
        return view('admin.sites.edit', compact('site'));
    }

    /**
     * Mise à jour d'un site.
     */
    public function update(Request $request, Sites $site): RedirectResponse
    {
        $data = $request->validate([
            'titre'        => ['required', 'string', 'max:255'],
            'ville'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'is_publishing'=> ['nullable'],
        ]);

        // Nouvelle image ?
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($site->image_url && Storage::disk('public')->exists($site->image_url)) {
                Storage::disk('public')->delete($site->image_url);
            }

            // Stocker la nouvelle image
            $data['image_url'] = $request->file('image')->store('sites', 'public');
        }

        $data['is_publishing'] = $request->has('is_publishing');

        $site->update($data);

        return redirect()
            ->route('admin.sites.index')
            ->with('success', 'Le site a été mis à jour avec succès.');
    }

    /**
     * Suppression d'un site.
     */
    public function destroy(Sites $site): RedirectResponse
    {
        // Supprimer l'image associée si elle existe
        if ($site->image_url && Storage::disk('public')->exists($site->image_url)) {
            Storage::disk('public')->delete($site->image_url);
        }

        $site->delete();

        return redirect()
            ->route('admin.sites.index')
            ->with('success', 'Le site a été supprimé.');
    }
}
