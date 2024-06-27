<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    public function index(): Response
    {
        $events = Event::with(['city', 'venue'])->latest()->get(); // Récupère tous les événements depuis la base de données

        return Inertia::render('Events/Index', [
            'events' => $events,
        
        ]);
    }

    public function create()
    {
        $city = City::with('venues')->first();

        return Inertia::render('Events/Create', ['city' => $city]);
    }

    public function show(string $id)
    {
        $event = Event::with(['city', 'venue'])->findOrFail($id);
        return Inertia::render('Events/Show', [
            'event' => $event,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'artists' => 'required|string',

            'city_id' => 'required|exists:cities,id',
            'venue_id' => 'required|exists:venues,id',
            'date' => 'required|date',
        ], [
            'city_id.exists' => 'The selected city is invalid.',
            'venue_id.exists' => 'The selected venue is invalid.',
        ]);

        //Event::create($request->only('title', 'description', 'city_id', 'venue_id', 'date', 'artists'));
        Event::create($validated);

        return redirect()->route('events.index');
    }

    public function edit(string $id)
    {
        $event = Event::with(['city', 'venue'])->findOrFail($id);

        return Inertia::render('Events/Edit', [
            'event' => $event,
            'venues' => $event->city->venues()->get(),
            'cities' => City::all(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',
            'venue_id' => 'required|exists:venues,id',
            'date' => 'required|date',
        ], [
            'city_id.exists' => 'The selected city is invalid.',
            'venue_id.exists' => 'The selected venue is invalid.',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->only('title', 'description', 'city_id', 'venue_id', 'date'));

        return redirect()->route('events.index');
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index');
    }
}
