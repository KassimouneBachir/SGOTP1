<div class="space-y-6 bg-white p-6 rounded-lg shadow">
    <!-- Titre -->
    <div>
        <label for="titre" class="block text-sm font-medium text-gray-700">Titre *</label>
        <input type="text" id="titre" name="titre" 
               value="{{ old('titre', $objet->titre ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
               required>
        @error('titre')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
        <textarea id="description" name="description" rows="4"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                  required>{{ old('description', $objet->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Catégorie -->
    <div>
        <label for="categorie" class="block text-sm font-medium text-gray-700">Catégorie *</label>
        <select id="categorie" name="categorie"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                required>
            @foreach([
                'vetement' => 'Vêtement',
                'electronique' => 'Électronique',
                'cosmetique' => 'Cosmétique',
                'document' => 'Document',
                'autre' => 'Autre'
            ] as $value => $label)
                <option value="{{ $value }}" 
                    {{ (old('categorie', $objet->categorie ?? '') == $value) ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('categorie')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Statut -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Statut *</label>
        <div class="mt-1 flex gap-4">
            <label class="inline-flex items-center">
                <input type="radio" name="statut" value="perdu"
                       {{ (old('statut', $objet->statut ?? '') == 'perdu') ? 'checked' : '' }}
                       class="text-blue-600 focus:ring-blue-500" required>
                <span class="ml-2">Perdu</span>
            </label>
            <label class="inline-flex items-center">
                <input type="radio" name="statut" value="trouvé"
                       {{ (old('statut', $objet->statut ?? '') == 'trouvé') ? 'checked' : '' }}
                       class="text-blue-600 focus:ring-blue-500">
                <span class="ml-2">Trouvé</span>
            </label>
        </div>
        @error('statut')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Photo -->
    <div>
        <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
        <input type="file" id="photo" name="photo"
               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        @error('photo')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        
        @if(isset($objet) && $objet->photo)
            <div class="mt-2">
                <img src="{{ asset('storage/'.$objet->photo) }}" 
                     alt="Photo actuelle" 
                     class="h-32 object-cover rounded">
                <p class="mt-1 text-sm text-gray-500">Photo actuelle</p>
            </div>
        @endif
    </div>

    <!-- Champs supplémentaires -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Lieu -->
        <div>
            <label for="lieu" class="block text-sm font-medium text-gray-700">Lieu *</label>
            <input type="text" id="lieu" name="lieu"
                   value="{{ old('lieu', $objet->lieu ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
            @error('lieu')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date -->
        <div>
            <label for="date_trouvaille" class="block text-sm font-medium text-gray-700">Date *</label>
            <input type="date" id="date_trouvaille" name="date_trouvaille"
                   value="{{ old('date_trouvaille', isset($objet) ? $objet->date_trouvaille->format('Y-m-d') : '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
            @error('date_trouvaille')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>