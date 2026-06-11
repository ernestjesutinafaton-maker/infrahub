<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tableau de bord Technicien
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded shadow">
                <table class="w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Titre</th>
                            <th class="p-3 text-left">Étudiant</th>
                            <th class="p-3 text-left">Priorité</th>
                            <th class="p-3 text-left">Statut</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr class="border-t">
                                <td class="p-3">{{ $ticket->titre }}</td>
                                <td class="p-3">{{ $ticket->user->name }}</td>
                                <td class="p-3">{{ $ticket->priorite }}</td>
                                <td class="p-3">{{ $ticket->statut }}</td>
                                <td class="p-3">
                                    <form method="POST" action="{{ route('technicien.updateStatut', $ticket) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="statut" class="border rounded p-1">
                                            <option value="nouveau" {{ $ticket->statut == 'nouveau' ? 'selected' : '' }}>Nouveau</option>
                                            <option value="en_cours" {{ $ticket->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                            <option value="resolu" {{ $ticket->statut == 'resolu' ? 'selected' : '' }}>Résolu</option>
                                            <option value="clos" {{ $ticket->statut == 'clos' ? 'selected' : '' }}>Clos</option>
                                        </select>
                                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded ml-2">
                                            Modifier
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-3 text-center text-gray-500">
                                    Aucun ticket.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>