<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\Sites;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
     * Enregistrement d’un nouveau site.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'titre'       => ['required', 'string', 'max:255'],
            'ville'       => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image'     => ['nullable', 'string', 'max:255'],
            'is_publishing' => ['nullable', 'boolean'],
        ]);

        // Checkbox non cochée = champ absent → on force false
        $data['is_publishing'] = $request->has('is_publishing');

        Sites::create($data);

        return redirect()
            ->route('admin.sites.index')
            ->with('success', 'Le site a été créé avec succès.');
    }

    /**
     * Formulaire d’édition.
     */
    public function edit(Sites $sites): View
    {
        return view('admin.sites.edit', compact('site'));
    }

    /**
     * Mise à jour d’un site.
     */
    public function update(Request $request, Sites $sites): RedirectResponse
    {
        $data = $request->validate([
            'titre'       => ['required', 'string', 'max:255'],
            'ville'       => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image'     => ['nullable', 'string', 'max:255'],
            'is_publishing' => ['nullable', 'boolean'],
        ]);

        $data['is_publishing'] = $request->has('is_publishing');

        $sites->update($data);

        return redirect()
            ->route('admin.sites.index')
            ->with('success', 'Le site a été mis à jour avec succès.');
    }

    /**
     * Suppression d’un site.
     */
    public function destroy(Sites $site): RedirectResponse
    {
        $site->delete();

        return redirect()
            ->route('admin.sites.index')
            ->with('success', 'Le site a été supprimé avec succès.');
    }
}
