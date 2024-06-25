<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Récupérer tous les clients
        $customers = Customer::with('user')->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        // Afficher le formulaire de création de client
        return view('customers.create');
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'nullable',
            'address' => 'nullable',
            'city' => 'nullable',
            'country' => 'nullable',
            // d'autres champs selon vos besoins
        ]);

        // Créer un nouvel utilisateur
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
        ]);

        // Créer un client associé à cet utilisateur
        $customer = Customer::create([
            'user_id' => $user->id,
            // d'autres champs spécifiques au client
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        // Afficher les détails d'un client spécifique
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        // Afficher le formulaire de modification de client
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $customer->user->id,
        ]);

        // Mettre à jour l'utilisateur associé
        $customer->user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        // Supprimer le client associé
        $customer->user->delete();

        // Rediriger avec un message de succès
        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
