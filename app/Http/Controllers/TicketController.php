<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Liste des tickets de l'utilisateur connecté
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->get();
        return view('tickets.index', compact('tickets'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('tickets.create');
    }

    // Enregistre le ticket en base
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'priorite' => 'required|in:normale,critique',
        ]);

        Ticket::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'priorite' => $request->priorite,
            'user_id' => Auth::id(),
            'statut' => 'nouveau',
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket créé avec succès !');
    }

    public function show(Ticket $ticket)
        {
            $commentaires = $ticket->commentaires()->with('user')->get();
            return view('tickets.show', compact('ticket', 'commentaires'));
        }
}