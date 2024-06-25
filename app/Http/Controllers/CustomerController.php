<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérer tous les clients
        $customers = Customer::with('user')->get();

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Afficher le formulaire de création de client
        return view('customers.create');
    }

    /**
     * Store a newly created customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified customer.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        // Afficher les détails d'un client spécifique
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        // Afficher le formulaire de modification de client
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified customer from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        // Supprimer le client associé
        $customer->user->delete();

        // Rediriger avec un message de succès
        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
