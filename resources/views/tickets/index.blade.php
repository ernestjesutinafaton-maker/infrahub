<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Mes tickets
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('tickets.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                Nouveau ticket
            </a>

            <div class="bg-white rounded shadow mt-4">
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
                        @forelse($tickets as $ticket)
                            <tr class="border-t">
                                <td class="p-3">{{ $ticket->titre }}</td>
                                <td class="p-3">{{ $ticket->priorite }}</td>
                                <td class="p-3">{{ $ticket->statut }}</td>
                                <td class="p-3">{{ $ticket->created_at->format('d/m/Y') }}</td>
                                <td class="p-3">
                                    <a href="{{ route('tickets.show', $ticket) }}"
                                    class="text-blue-500 hover:underline">
                                        Voir
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-3 text-center text-gray-500">
                                    Aucun ticket pour l'instant.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>