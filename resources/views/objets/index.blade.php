<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Objets Perdus/Trouvés</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('objets.create') }}" class="btn-primary">
                    + Ajouter un objet
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($objets as $objet)
                    @include('objets.partials.card', ['objet' => $objet])
                @endforeach
            </div>

            <div class="mt-6">
                {{ $objets->links() }}
            </div>
        </div>
    </div>
</x-app-layout>