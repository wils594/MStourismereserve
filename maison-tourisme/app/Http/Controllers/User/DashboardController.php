<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Site;

class DashboardController extends Controller
{
    public function index()
    {
        // On récupère les sites publiés, les plus récents en premier
        $sites = Site::where('is_published', true)
            ->latest()
            ->get();

        return view('user.dashboard', compact('sites'));
    }
}
