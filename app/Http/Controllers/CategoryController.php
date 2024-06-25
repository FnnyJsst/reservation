<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Récupérer toutes les catégories
        $categories = Category::all();
        
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        // Afficher le formulaire de création de catégorie
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        // Créer une nouvelle catégorie
        Category::create([
            'name' => $request->input('name'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        // Afficher une catégorie spécifique
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        // Afficher le formulaire de modification de catégorie
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        // Mettre à jour la catégorie
        $category->update([
            'name' => $request->input('name'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Supprimer la catégorie
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
