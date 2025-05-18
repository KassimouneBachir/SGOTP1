<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold">Objets récemment trouvés</h1>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($objets as $objet)
            <div class="bg-white rounded-lg shadow p-4">
                @if($objet->photo)
                    <img src="{{ asset('storage/'.$objet->photo) }}" class="w-full h-48 object-cover mb-4">
                @endif
                <h3 class="font-bold">{{ $objet->titre }}</h3>
                <p class="text-gray-600">{{ $objet->lieu }}</p>
                <p class="text-sm text-gray-400">{{ $objet->created_at->diffForHumans() }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>