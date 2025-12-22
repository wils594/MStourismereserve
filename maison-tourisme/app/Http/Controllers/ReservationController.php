<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Formulaire de réservation
     */
    public function create(Sites $site)
    {
        return view('reservations.create', compact('site'));
    }

    /**
     * Enregistrer la réservation
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'site_id'      => 'required|exists:sites,id',
            'nom_complet'  => 'required|string|max:255',
            'pays_origine' => 'required|string|max:255',
            'langue'       => 'required|string|max:255',
            'date_arrivee' => 'required|date',
            'date_depart'  => 'required|date|after:date_arrivee',
            'type_groupe'  => 'required|in:individuel,groupe',
            'adultes'      => 'required|integer|min:1',
            'enfants'      => 'nullable|integer|min:0',
        ]);

        $jours = Carbon::parse($data['date_arrivee'])
            ->diffInDays(Carbon::parse($data['date_depart']));

        Reservation::create([
            'user_id'         => auth()->id(),
            'site_id'         => $data['site_id'],
            'nom_complet'     => $data['nom_complet'],
            'pays_origine'    => $data['pays_origine'],
            'langue'          => $data['langue'],
            'date_arrivee'    => $data['date_arrivee'],
            'date_depart'     => $data['date_depart'],
            'nombre_jours'    => $jours,
            'type_groupe'     => $data['type_groupe'],
            'adultes'         => $data['adultes'],
            'enfants'         => $data['enfants'] ?? 0,
            'total_personnes' => $data['adultes'] + ($data['enfants'] ?? 0),
            'statut'          => Reservation::STATUT_EN_ATTENTE,
        ]);

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Votre réservation a été envoyée.');
    }

    /**
     * Liste des réservations de l'utilisateur
     */
    public function index()
    {
        $reservations = Reservation::with('site')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.dashboard', compact('reservations'));
    }

    /**
     * Formulaire de modification
     */
    public function edit(Reservation $reservation)
    {
        // Sécurité : uniquement le propriétaire
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        // Blocage si déjà traitée
        if ($reservation->statut !== Reservation::STATUT_EN_ATTENTE) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'Cette réservation ne peut plus être modifiée.');
        }

        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Mise à jour de la réservation
     */
    public function update(Request $request, Reservation $reservation)
    {
        // Sécurité : uniquement le propriétaire
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        // Blocage si déjà traitée
        if ($reservation->statut !== Reservation::STATUT_EN_ATTENTE) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'Modification impossible.');
        }

        $data = $request->validate([
            'pays_origine' => 'required|string|max:255',
            'langue'       => 'required|string|max:255',
            'date_arrivee' => 'required|date',
            'date_depart'  => 'required|date|after:date_arrivee',
            'type_groupe'  => 'required|in:individuel,groupe',
            'adultes'      => 'required|integer|min:1',
            'enfants'      => 'nullable|integer|min:0',
        ]);

        $jours = Carbon::parse($data['date_arrivee'])
            ->diffInDays(Carbon::parse($data['date_depart']));

        $reservation->update([
            'pays_origine'    => $data['pays_origine'],
            'langue'          => $data['langue'],
            'date_arrivee'    => $data['date_arrivee'],
            'date_depart'     => $data['date_depart'],
            'type_groupe'     => $data['type_groupe'],
            'adultes'         => $data['adultes'],
            'enfants'         => $data['enfants'] ?? 0,
            'nombre_jours'    => $jours,
            'total_personnes' => $data['adultes'] + ($data['enfants'] ?? 0),
        ]);

        return redirect()
    ->route('user.dashboard')
    ->with('success', 'Votre réservation a été envoyée.');

}
}