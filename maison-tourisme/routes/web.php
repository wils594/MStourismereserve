<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\SitePublicController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReactionController;

// Admin controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SitesController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;

use App\Models\Sites;
use App\Models\Reservation;

/*
|--------------------------------------------------------------------------
| Accueil public
|--------------------------------------------------------------------------
*/
Route::get('/', [SitePublicController::class, 'index'])->name('home');
Route::view('/a-propos', 'apropos')->name('apropos');
Route::view('/contact', 'contact')->name('contact');

/*
|--------------------------------------------------------------------------
| Discussion (public)
|--------------------------------------------------------------------------
*/
Route::get('/discussion', [PostController::class, 'index'])->name('discussion');

/*
|--------------------------------------------------------------------------
| Routes utilisateur (auth + verified)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    | Dashboard utilisateur
    */
    Route::get('/espace-client', function () {

        $reservations = Reservation::with('site')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.dashboard', compact('reservations'));

    })->name('user.dashboard');

    /*
    | Réservations utilisateur
    */
    Route::get('/reserver/{site}', [ReservationController::class, 'create'])
        ->name('reservation.create');

    Route::post('/reserver', [ReservationController::class, 'store'])
        ->name('reservation.store');

    Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])
        ->name('reservation.edit');

    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])
        ->name('reservation.update');

    /*
    | Commentaires & interactions
    */
    Route::post('/commentaires', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');

    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])
        ->name('posts.like');

    Route::post('/posts/{post}/reaction', [ReactionController::class, 'toggle'])
        ->name('posts.reaction');

    /*
    | Discussion (création)
    */
    Route::post('/discussion', [PostController::class, 'store'])
        ->name('discussion.store');

    /*
    | Accueil utilisateur + recherche
    */
    Route::get('/accueil', function (Request $request) {

        $query = Sites::where('is_publishing', true);

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('titre', 'like', "%{$q}%")
                    ->orWhere('ville', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        $sites = $query->orderBy('created_at', 'desc')->get();
        return view('accueil', compact('sites'));

    })->name('accueil');

    Route::get('/sites/{site}', [SitePublicController::class, 'show'])
        ->name('sites.show');

    /*
    | Redirection dashboard Laravel par défaut
    */
    Route::get('/dashboard', fn () => redirect()->route('accueil'))
        ->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Routes Admin (STRUCTURE UNIQUE)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', 'is_admin'])
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Sites touristiques
        Route::resource('sites', SitesController::class);

        // Réservations admin
        Route::get('/reservations', [AdminReservationController::class, 'index'])
            ->name('reservations.index');

        Route::get('/reservations/{reservation}', [AdminReservationController::class, 'show'])
            ->name('reservations.show');

        Route::post('/reservations/{reservation}/valider', [AdminReservationController::class, 'valider'])
            ->name('reservations.valider');

        Route::post('/reservations/{reservation}/refuser', [AdminReservationController::class, 'refuser'])
            ->name('reservations.refuser');
    });
    use App\Http\Controllers\Admin\VisitorController;

Route::prefix('admin')
    ->middleware(['auth', 'is_admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('sites', \App\Http\Controllers\Admin\SitesController::class);

        // VISITEURS
        Route::get('/visitors', [VisitorController::class, 'index'])
            ->name('visitors.index');

        // PARAMÈTRES
        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('settings');
        
    });



/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
