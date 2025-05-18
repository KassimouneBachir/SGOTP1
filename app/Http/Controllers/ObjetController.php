<?php

namespace App\Http\Controllers;

use App\Models\Objet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObjetController extends Controller
{
    // Affiche la liste paginée
    public function index()
    {
        return view('objets.index', [
            'objets' => Objet::with('user')
                        ->latest()
                        ->paginate(10)
        ]);
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('objets.create');
    }

    // Stocke un nouvel objet
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'lieu' => 'required|string|max:255',
            'date_trouvaille' => 'required|date',
            'photo' => 'nullable|image|max:2048',
            'categorie' => 'required|in:vetement,electronique,cosmetique,document,autre',
            'statut' => 'required|in:perdu,trouvé'
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('objets', 'public');
        }

        $validated['user_id'] = auth()->id();
        Objet::create($validated);

        return redirect()->route('objets.index')
                         ->with('success', 'Objet créé avec succès!');
    }

    // Affiche un objet spécifique
    public function show(Objet $objet)
    {
        return view('objets.show', compact('objet'));
    }

    // Affiche le formulaire d'édition
    public function edit(Objet $objet)
    {
        return view('objets.edit', compact('objet'));
    }

    // Met à jour un objet
    public function update(Request $request, Objet $objet)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'lieu' => 'required|string|max:255',
            'date_trouvaille' => 'required|date',
            'photo' => 'nullable|image|max:2048',
            'categorie' => 'required|in:vetement,electronique,cosmetique,document,autre',
            'statut' => 'required|in:perdu,trouvé'
        ]);

        if ($request->hasFile('photo')) {
            if ($objet->photo) {
                Storage::disk('public')->delete($objet->photo);
            }
            $validated['photo'] = $request->file('photo')->store('objets', 'public');
        }

        $objet->update($validated);

        return redirect()->route('objets.show', $objet)
                         ->with('success', 'Objet mis à jour!');
    }

    // Supprime un objet
    public function destroy(Objet $objet)
    {
        if ($objet->photo) {
            Storage::disk('public')->delete($objet->photo);
        }

        $objet->delete();

        return redirect()->route('objets.index')
                         ->with('success', 'Objet supprimé!');
    }

    public function welcome()
    {
    return view('welcome', [
        'recentObjets' => Objet::where('statut', 'trouvé')
                             ->latest()
                             ->take(2)
                             ->get()
    ]);
    }

    public function publicIndex()
    {
    return view('objets.public', [
        'objets' => Objet::where('statut', 'trouvé')
                        ->latest()
                        ->paginate(6)
    ]);
    }
}