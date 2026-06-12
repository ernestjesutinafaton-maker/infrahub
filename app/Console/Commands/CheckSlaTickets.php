<?php

namespace App\Console\Commands;

use App\Mail\UrgenceAlert;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckSlaTickets extends Command
{
    protected $signature = 'sla:check';
    protected $description = 'Verifie les tickets et envoie les alertes';

    public function handle()
    {
        // Urgences — escalade après 30 minutes
        $urgences = Ticket::where('statut', 'nouveau')
            ->where('priorite', 'urgence')
            ->where('created_at', '<=', now()->subSeconds(10))
            ->get();

        foreach ($urgences as $ticket) {
            $ticket->update(['statut' => 'en_cours']);

            // Envoie email à tous les techniciens
            $techniciens = User::where('role', 'technicien')->get();
            foreach ($techniciens as $technicien) {
                Mail::to($technicien->email)->send(new UrgenceAlert($ticket));
            }

            $this->info("URGENCE #{$ticket->id} escaladee + email envoye !");
        }

        // Critiques — escalade après 24h
        $critiques = Ticket::where('statut', 'nouveau')
            ->where('priorite', 'critique')
            ->where('created_at', '<=', now()->subSeconds(30))
            ->get();

        foreach ($critiques as $ticket) {
            $ticket->update(['statut' => 'en_cours']);
            $this->info("Ticket #{$ticket->id} escalade !");
        }

        $this->info("SLA verifie !");
    }
}