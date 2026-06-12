<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Créer un ticket
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">

                <form method="POST" action="{{ route('tickets.store') }}">
                    @csrf
                                        @if($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="block font-bold mb-1">Titre</label>
                        <input type="text" name="titre" class="w-full border rounded p-2" required>
                        @error('titre') <p class="text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-1">Description</label>
                        <textarea name="description" rows="4" class="w-full border rounded p-2" required></textarea>
                        @error('description') <p class="text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-1">Priorité</label>
                                <select name="priorite" class="w-full border rounded p-2">
                                    <option value="normale">Normale</option>
                                    <option value="critique">Critique</option>
                                    <option value="urgence"> URGENCE - Vie en danger</option>
                                </select>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Soumettre le ticket
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>