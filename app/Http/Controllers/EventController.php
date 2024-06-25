<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    public function index(): Response
    {
        $events = Event::with('city', 'venue')->paginate(10); // Paginate events

        return Inertia::render('Events/Index', [
            'events' => $events,
        ]);
    }

    public function create()
    {
        return Inertia::render('Events/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',
            'venue_id' => 'required|exists:venues,id',
            'date' => 'required|date',
        ], [
            'city_id.exists' => 'The selected city is invalid.',
            'venue_id.exists' => 'The selected venue is invalid.',
        ]);

        Event::create($request->only('name', 'description', 'city_id', 'venue_id', 'date'));

        return redirect()->route('events.index');
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);

        return Inertia::render('Events/Edit', [
            'event' => $event,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',
            'venue_id' => 'required|exists:venues,id',
            'date' => 'required|date',
        ], [
            'city_id.exists' => 'The selected city is invalid.',
            'venue_id.exists' => 'The selected venue is invalid.',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->only('name', 'description', 'city_id', 'venue_id', 'date'));

        return redirect()->route('events.index');
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index');
    }
}
