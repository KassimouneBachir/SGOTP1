<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Détails de l'objet
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('objets.edit', $objet->id) }}" class="px-4 py-2 text-sm text-white bg-yellow-600 rounded-md hover:bg-yellow-700">
                    Modifier
                </a>
                <form action="{{ route('objets.destroy', $objet->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-red-600 rounded-md hover:bg-red-700" onclick="return confirm('Confirmer la suppression ?')">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        <div class="image-wrapper" id="imageWrapper" style="
    max-width: 100%;
    display: inline-block;
    background-color: #f3f4f6;
    line-height: 0; /* Supprime l'espace sous l'image */
">
    <img 
        src="{{ asset('storage/'.$objet->photo) }}" 
        alt="{{ $objet->titre }}"
        id="dynamicImage"
        style="max-width: 100%; height: auto;"
        onload="adaptBackground(this)"
    >
</div>

<script>
function adaptBackground(img) {
    const wrapper = img.parentElement;
    // Applique les dimensions exactes de l'image au wrapper
    wrapper.style.width = img.naturalWidth + 'px';
    wrapper.style.height = img.naturalHeight + 'px';
    
    // Optionnel : Ajoute un contour esthétique
    wrapper.style.border = '1px solid #e5e7eb';
    wrapper.style.borderRadius = '0.5rem';
}
</script>

                        <!-- Détails -->
                        <div class="space-y-6">
                            <div>
                                <h1 class="text-2xl font-bold">{{ $objet->titre }}</h1>
                                <div class="flex items-center mt-2 space-x-4">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                              {{ $objet->statut === 'trouvé' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($objet->statut) }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        {{ $objet->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Catégorie</h3>
                                    <p class="mt-1">{{ config('categories_yahya.objets.'.$objet->categorie) }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Lieu</h3>
                                    <p class="mt-1">{{ $objet->lieu }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Date</h3>
                                    <p class="mt-1">{{ $objet->date_trouvaille->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Déposé par</h3>
                                    <p class="mt-1">{{ $objet->user->name }}</p>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Description</h3>
                                <p class="mt-1 whitespace-pre-line">{{ $objet->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>