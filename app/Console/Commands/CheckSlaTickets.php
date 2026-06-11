<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Illuminate\Console\Command;

class CheckSlaTickets extends Command
{
    protected $signature = 'sla:check';
    protected $description = 'Vérifie les tickets critiques non pris en charge après 24h';

    public function handle()
    {
        $tickets = Ticket::where('statut', 'nouveau')
            ->where('priorite', 'critique')
            ->where('created_at', '<=', now()->subHours(24))
            ->get();

        foreach ($tickets as $ticket) {
            $ticket->update(['statut' => 'en_cours']);
            $this->info("Ticket #{$ticket->id} escaladé automatiquement !");
        }

        $this->info("SLA vérifié — {$tickets->count()} ticket(s) escaladé(s).");
    }
}