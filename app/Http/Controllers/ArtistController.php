<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtisteController extends Controller
{
    public function index()
    {
        // Récupérer tous les artistes
        $artists = Artist::all();

        // Retourner la vue avec les données des artistes
        return view('artists.index', compact('artists'));
    }

    public function create()
    {
        // Afficher le formulaire de création d'artiste
        return view('artists.create');
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|unique:artists,name',
        ]);

        // Créer un nouvel artiste
        Artist::create([
            'name' => $request->input('name'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('artists.index')
            ->with('success', 'Artist created successfully.');
    }

    public function show(Artist $artist)
    {
        // Afficher les détails d'un artiste spécifique
        return view('artists.show', compact('artist'));
    }

    public function edit(Artist $artist)
    {
        // Afficher le formulaire de modification d'artiste
        return view('artists.edit', compact('artist'));
    }

    public function update(Request $request, Artist $artist)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|unique:artists,name,' . $artist->id,
        ]);

        // Mettre à jour l'artiste
        $artist->update([
            'name' => $request->input('name'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('artists.index')
            ->with('success', 'Artist updated successfully.');
    }

    /**
     * Remove the specified artist from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        // Supprimer l'artiste
        $artist->delete();

        // Rediriger avec un message de succès
        return redirect()->route('artists.index')
            ->with('success', 'Artist deleted successfully.');
    }
}
