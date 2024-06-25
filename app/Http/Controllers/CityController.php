<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        // Récupérer toutes les villes
        $cities = City::all();

        // Retourner la vue 
        return view('cities.index', compact('cities'));
    }

    public function create()
    {
        // Afficher le formulaire de création de ville
        return view('cities.create');
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|unique:cities,name',
        ]);

        // Créer une nouvelle ville
        City::create([
            'name' => $request->input('name'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('cities.index')
            ->with('success', 'City created successfully.');
    }

    public function show(City $city)
    {
        // Afficher les détails d'une ville spécifique
        return view('cities.show', compact('city'));
    }

    public function edit(City $city)
    {
        // Afficher le formulaire de modification de ville
        return view('cities.edit', compact('city'));
    }

    public function update(Request $request, City $city)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|unique:cities,name,' . $city->id,
        ]);

        // Mettre à jour la ville
        $city->update([
            'name' => $request->input('name'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('cities.index')
            ->with('success', 'City updated successfully.');
    }

    public function destroy(City $city)
    {
        // Supprimer la ville
        $city->delete();

        // Rediriger avec un message de succès
        return redirect()->route('cities.index')
            ->with('success', 'City deleted successfully.');
    }
}
