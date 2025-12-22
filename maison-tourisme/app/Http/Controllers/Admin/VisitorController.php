<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class VisitorController extends Controller
{
    public function index()
    {
        // Tous les utilisateurs non admin = visiteurs
        $visitors = User::where('is_admin', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.visitors.index', compact('visitors'));
    }
}
