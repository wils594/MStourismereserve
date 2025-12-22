<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('site')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.dashboard', compact('reservations'));
    }
}
