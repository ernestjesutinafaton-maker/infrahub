<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TechnicienController extends Controller
{
    // Affiche tous les tickets
    public function index()
    {
        $tickets = Ticket::with('user')->orderBy('created_at', 'desc')->get();
        return view('technicien.index', compact('tickets'));
    }

    // Change le statut d'un ticket
    public function updateStatut(Request $request, Ticket $ticket)
    {
        $request->validate([
            'statut' => 'required|in:nouveau,en_cours,resolu,clos',
        ]);

        $ticket->update(['statut' => $request->statut]);

        return redirect()->route('technicien.index')
            ->with('success', 'Statut mis à jour !');
    }
}