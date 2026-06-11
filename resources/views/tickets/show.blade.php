<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Ticket : {{ $ticket->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Détails du ticket --}}
            <div class="bg-white rounded shadow p-6 mb-6">
                <h3 class="font-bold text-lg mb-2">{{ $ticket->titre }}</h3>
                <p class="text-gray-600 mb-4">{{ $ticket->description }}</p>
                <div class="flex gap-4">
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded">
                        {{ $ticket->statut }}
                    </span>
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded">
                        {{ $ticket->priorite }}
                    </span>
                </div>
            </div>

            {{-- Liste des commentaires --}}
            <div class="bg-white rounded shadow p-6 mb-6">
                <h3 class="font-bold text-lg mb-4">Commentaires</h3>

                @forelse($commentaires as $commentaire)
                    <div class="border-b py-3">
                        <p class="font-semibold">{{ $commentaire->user->name }}</p>
                        <p class="text-gray-600">{{ $commentaire->contenu }}</p>
                        <p class="text-gray-400 text-sm">
                            {{ $commentaire->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500">Aucun commentaire pour l'instant.</p>
                @endforelse
            </div>

            {{-- Formulaire commentaire --}}
            <div class="bg-white rounded shadow p-6">
                <h3 class="font-bold text-lg mb-4">Ajouter un commentaire</h3>

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('commentaires.store', $ticket) }}">
                    @csrf
                    <textarea name="contenu" rows="3"
                        class="w-full border rounded p-2 mb-3"
                        placeholder="Votre commentaire..." required></textarea>
                    @error('contenu')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded">
                        Envoyer
                    </button>
                </form>
            </div>

            <a href="{{ route('tickets.index') }}"
               class="inline-block mt-4 text-blue-500 hover:underline">
                ← Retour aux tickets
            </a>

        </div>
    </div>
</x-app-layout>