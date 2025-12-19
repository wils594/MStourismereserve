<?php

namespace App\Http\Controllers;

use App\Models\Sites;

class SitePublicController extends Controller
{
    /**
     * Page publique : grille de tous les sites publiés
     */
    public function index()
    {
        $sites = Sites::where('is_publishing', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('welcome', compact('sites'));
    }

    /**
     * Détail d’un site
     */
    public function show(Sites $site)
    {
        abort_if(!$site->is_publishing, 404);

        return view('sites.show', compact('site'));
    }
}
