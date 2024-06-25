<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ReservationController extends Controller
{

    public function index(): Response
    {
        $reservations = Reservation::all();

        return Inertia::render('Reservations/Index', [
            'reservations' => $reservations,
        ]);
    }

    public function create()
    {
        return Inertia::render('Reservations/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'comment' => 'nullable|string',
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservations.index');
    }

    public function show(string $id)
    {
        $reservation = Reservation::findOrFail($id);

        return Inertia::render('Reservations/Show', [
            'reservation' => $reservation,
        ]);
    }

    public function edit(string $id)
    {
        $reservation = Reservation::findOrFail($id);

        return Inertia::render('Reservations/Edit', [
            'reservation' => $reservation,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'comment' => 'nullable|string',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());

        return redirect()->route('reservations.index');
    }

    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index');
    }
}
