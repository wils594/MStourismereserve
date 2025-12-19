<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SitesController;
use App\Http\Controllers\SitePublicController;
use App\Models\Sites;

/*
|--------------------------------------------------------------------------
| Accueil public
|--------------------------------------------------------------------------
*/
Route::get('/', [SitePublicController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| Routes utilisateur (front-office)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    /*
     | Accueil utilisateur (même logique que home, sans limite)
     */
    Route::get('/accueil', function () {

        $sites = Sites::where('is_publishing', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('accueil', compact('sites'));
    })->name('accueil');

    /*
     | Détail site
     */
    Route::get('/sites/{site}', [SitePublicController::class, 'show'])
        ->name('sites.show');

    /*
     | Espace client
     */
    Route::get('/espace-client', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    /*
     | Redirection dashboard
     */
    Route::get('/dashboard', function () {
        return redirect()->route('accueil');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Routes Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('sites', SitesController::class);
    });

require __DIR__ . '/auth.php';
