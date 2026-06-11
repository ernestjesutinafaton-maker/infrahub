<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'contenu' => 'required|string',
        ]);

        Commentaire::create([
            'contenu' => $request->contenu,
            'user_id' => Auth::id(),
            'ticket_id' => $ticket->id,
        ]);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Commentaire ajouté !');
    }
}