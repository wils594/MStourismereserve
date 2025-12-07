<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;

// Page d'accueil publique (avant connexion)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Pages pour utilisateurs connectés
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/accueil', function () {
        return view('accueil');
    })->name('accueil');

    Route::get('/espace-client', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/dashboard', function () {
        return redirect()->route('accueil');
    })->name('dashboard');
});

// Admin seulement
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
    });

require __DIR__.'/auth.php';