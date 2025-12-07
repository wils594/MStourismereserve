<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentification via LoginRequest (Breeze)
        $request->authenticate();

        // Regénération de la session
        $request->session()->regenerate();

        // On récupère l'utilisateur connecté
        $user = $request->user(); // équivalent à Auth::user()

        //  Si c'est un admin → tableau de bord admin
        if ($user && $user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        //  Sinon (user normal) → page accueil
        return redirect()->intended(route('accueil', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
