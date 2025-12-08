<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SitesController;
use App\Models\Sites;


// Page d'accueil publique (avant connexion)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Pages pour utilisateurs connectés
Route::middleware(['auth', 'verified'])->group(function () {

    // Page Accueil après login / inscription
    Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/accueil', function () {
        $sites = Sites::where('is_publishing', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('accueil', compact('sites'));
    })->name('accueil');

    // ...
});


    // ... le reste (espace-client, profile, etc.)
});


    Route::get('/espace-client', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/dashboard', function () {
        return redirect()->route('accueil');
    })->name('dashboard');


// Admin seulement
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
    });

// Admin Sites
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // CRUD des sites touristiques
        Route::resource('sites', SitesController::class);
    });

require __DIR__.'/auth.php';