<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Site;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /** --------------------
         *  STATISTIQUES GLOBALES
         *  -------------------- */

        // Visiteurs (utilisateurs non admin)
        $visiteursCount = User::where('role', '!=', 'admin')->count();

        // Arrivées = toutes les réservations
        $totalArrivees = Reservation::count();

        // Départs = réservations avec date_depart renseignée
        $totalDeparts = Reservation::whereNotNull('date_depart')->count();

        /** --------------------
         *  STATISTIQUES MENSUELLES (DYNAMIQUES)
         *  -------------------- */

        $arriveesStats = Reservation::select(
                DB::raw('MONTH(date_arrivee) as mois'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $departsStats = Reservation::whereNotNull('date_depart')
            ->select(
                DB::raw('MONTH(date_depart) as mois'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // Labels fixes (Jan → Déc)
        $labels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];

        $arriveesParMois = array_fill(0, 12, 0);
        $departsParMois  = array_fill(0, 12, 0);

        foreach ($arriveesStats as $row) {
            $arriveesParMois[$row->mois - 1] = $row->total;
        }

        foreach ($departsStats as $row) {
            $departsParMois[$row->mois - 1] = $row->total;
        }

        /** --------------------
         *  RÉSERVATIONS RÉCENTES
         *  -------------------- */

        $reservationsRecentes = Reservation::with('site')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact(
            'visiteursCount',
            'totalArrivees',
            'totalDeparts',
            'labels',
            'arriveesParMois',
            'departsParMois',
            'reservationsRecentes'
        ));
    }
}
