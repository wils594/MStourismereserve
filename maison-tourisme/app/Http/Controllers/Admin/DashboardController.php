<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\Sites;

class DashboardController extends Controller
{
    public function index()
    {
        $publishedSites = Sites::where('is_publishing', true)->count();

        return view('admin.dashboard', [
            'publishedSites' => $publishedSites,
        ]);
    }
}
