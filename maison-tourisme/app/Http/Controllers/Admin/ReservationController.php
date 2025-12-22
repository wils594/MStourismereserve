<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationRefuseeMail;
use App\Models\Site
;

class ReservationController extends Controller
{
    /**
     * Liste de toutes les réservations
     */
    public function index()
    {
        $reservations = Reservation::with(['site', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Détails d'une réservation
     */
    public function show(Reservation $reservation)
    {
        $reservation->load(['site', 'user']);

        return view('admin.reservations.show', compact('reservation'));
    }

    /**
     * Valider une réservation
     */
    public function valider(Reservation $reservation)
    {
        $reservation->update([
            'statut' => Reservation::STATUT_VALIDEE,
        ]);

        return redirect()
            ->route('admin.reservations.index')
            ->with('success', 'Réservation validée avec succès.');
    }

    /**
     * Refuser une réservation
     */
    public function refuser(Request $request, Reservation $reservation)
{
    $request->validate([
        'motif_refus' => 'required|string|min:5',
    ]);

    $reservation->update([
        'statut' => Reservation::STATUT_REFUSEE,
        'motif_refus' => $request->motif_refus,
    ]);

    // 📧 ENVOI EMAIL
    Mail::to($reservation->user->email)
        ->send(new ReservationRefuseeMail($reservation));

    return redirect()
        ->route('admin.reservations.show', $reservation)
        ->with('success', 'Réservation refusée et email envoyé au client.');
}

    
}
