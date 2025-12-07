<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si pas connecté OU pas admin → accès refusé
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Accès refusé.');
        }

        return $next($request);
    }
}
