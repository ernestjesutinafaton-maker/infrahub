<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(Auth::user()->role === 'technicien')

                {{-- Dashboard Technicien --}}
                <div class="grid grid-cols-4 gap-4 mb-6">
                    <div class="bg-blue-500 text-white p-4 rounded shadow text-center">
                        <p class="text-2xl font-bold">{{ $stats['total'] }}</p>
                        <p>Total tickets</p>
                    </div>
                    <div class="bg-yellow-500 text-white p-4 rounded shadow text-center">
                        <p class="text-2xl font-bold">{{ $stats['nouveau'] }}</p>
                        <p>Nouveaux</p>
                    </div>
                    <div class="bg-green-500 text-white p-4 rounded shadow text-center">
                        <p class="text-2xl font-bold">{{ $stats['en_cours'] }}</p>
                        <p>En cours</p>
                    </div>
                    <div class="bg-red-500 text-white p-4 rounded shadow text-center">
                        <p class="text-2xl font-bold">{{ $stats['critique'] }}</p>
                        <p>Critiques</p>
                    </div>
                </div>

                <div class="bg-white rounded shadow p-6">
                    <h3 class="font-bold text-lg mb-4">Tickets récents</h3>
                    <table class="w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-3 text-left">Titre</th>
                                <th class="p-3 text-left">Étudiant</th>
                                <th class="p-3 text-left">Priorité</th>
                                <th class="p-3 text-left">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets_recents as $ticket)
                                <tr class="border-t">
                                    <td class="p-3">{{ $ticket->titre }}</td>
                                    <td class="p-3">{{ $ticket->user->name }}</td>
                                    <td class="p-3">{{ $ticket->priorite }}</td>
                                    <td class="p-3">{{ $ticket->statut }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-3 text-center text-gray-500">
                                        Aucun ticket.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            @else

                {{-- Dashboard Étudiant --}}
                <div class="bg-white rounded shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg">Mes tickets</h3>
                        <a href="{{ route('tickets.create') }}"
                           class="bg-blue-500 text-white px-4 py-2 rounded">
                            Nouveau ticket
                        </a>
                    </div>
                    <table class="w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-3 text-left">Titre</th>
                                <th class="p-3 text-left">Priorité</th>
                                <th class="p-3 text-left">Statut</th>
                                <th class="p-3 text-left">Date</th>
                                <th class="p-3 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mes_tickets as $ticket)
                                <tr class="border-t">
                                    <td class="p-3">{{ $ticket->titre }}</td>
                                    <td class="p-3">{{ $ticket->priorite }}</td>
                                    <td class="p-3">{{ $ticket->statut }}</td>
                                    <td class="p-3">{{ $ticket->created_at->format('d/m/Y') }}</td>
                                    <td class="p-3">
                                        <a href="{{ route('tickets.show', $ticket) }}"
                                           class="text-blue-500 hover:underline">Voir</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-3 text-center text-gray-500">
                                        Aucun ticket pour l'instant.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            @endif

        </div>
    </div>
</x-app-layout>