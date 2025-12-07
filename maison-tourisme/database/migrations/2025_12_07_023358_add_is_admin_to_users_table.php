<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si l'utilisateur est connecté et admin
        if (!Auth::check() || Auth::user()->is_admin !== true) {
            abort(403, 'Accès refusé.');
        }

        return $next($request);
    }
}
