<?php
namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Event::with(['city', 'venue']);

        if ($request->filled('city')) {
            $query->whereHas('city', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->city . '%');
            });
        }

        if ($request->filled('artist')) {
            $query->where('artists', 'like', '%' . $request->artist . '%');
        }

        if ($request->filled('venue')) {
            $query->whereHas('venue', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->venue . '%');
            });
        }

        $events = $query->latest()->get();

        return Inertia::render('Events/Index', [
            'events' => $events,
            'filters' => $request->only(['city', 'artist', 'venue']),
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

    public function destroy($id)
    {
        $event = Event::find($id);
    
        if ($event) {
            $event->delete();
            return response()->json(null, 204);
        }
    
        return response()->json(['message' => 'Event not found'], 404);
    }
}
?>