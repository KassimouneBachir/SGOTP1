<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    @if($objet->photo)
        <img src="{{ asset('storage/'.$objet->photo) }}" alt="{{ $objet->titre }}" class="w-full h-48 object-cover">
    @endif

    <div class="p-6">
        <h3 class="text-lg font-semibold">{{ $objet->titre }}</h3>
        <p class="text-gray-600 mt-2">{{ Str::limit($objet->description, 100) }}</p>
        
        <div class="mt-4 flex justify-between items-center">
            <span class="px-2 py-1 text-xs rounded-full 
                      {{ $objet->statut === 'trouvé' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                {{ ucfirst($objet->statut) }}
            </span>
            <a href="{{ route('objets.show', $objet->id) }}" class="text-blue-500 hover:underline">Voir</a>
        </div>
    </div>
</div>