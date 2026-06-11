<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'technicien') {
            $stats = [
                'total' => Ticket::count(),
                'nouveau' => Ticket::where('statut', 'nouveau')->count(),
                'en_cours' => Ticket::where('statut', 'en_cours')->count(),
                'resolu' => Ticket::where('statut', 'resolu')->count(),
                'critique' => Ticket::where('priorite', 'critique')->count(),
            ];
            $tickets_recents = Ticket::with('user')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            return view('dashboard', compact('stats', 'tickets_recents'));
        }

        // Étudiant
        $mes_tickets = Ticket::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashboard', compact('mes_tickets'));
    }
}