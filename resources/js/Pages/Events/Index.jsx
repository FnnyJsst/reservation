import axios from 'axios';
import React, { useState } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Index({ auth, events, filters }) {
    const [search, setSearch] = useState({
        city: filters.city || '',
        artist: filters.artist || '',
        venue: filters.venue || ''
    });

    const handleSearchChange = (e) => {
        setSearch({
            ...search,
            [e.target.name]: e.target.value
        });
    };

    const handleSearchSubmit = (e) => {
        e.preventDefault();
        axios.get(route('events.index'), { params: search })
            .then(response => {
                // Rediriger vers l'index avec les paramètres de recherche
                window.location.href = route('events.index', search);
            });
    };

    if (!Array.isArray(events)) {
        events = [];
    }

    function deleteEvent(id) {
        axios.delete(route('events.destroy', id))
            .then(() => {
                window.location.href = route('events.index');
            });
    }

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Events" />

            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <div className="flex justify-between items-center mb-4">
                    <h1 className="text-2xl font-bold">All Events</h1>
                    <Link href={route('events.create')} className="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">
                        Create an Event
                    </Link>
                </div>

                <form onSubmit={handleSearchSubmit} className="mb-4">
                    <div className="flex space-x-2">
                        <input
                            type="text"
                            name="city"
                            value={search.city}
                            onChange={handleSearchChange}
                            placeholder="Search by city"
                            className="border rounded py-2 px-3"
                        />
                        <input
                            type="text"
                            name="artist"
                            value={search.artist}
                            onChange={handleSearchChange}
                            placeholder="Search by artist"
                            className="border rounded py-2 px-3"
                        />
                        <input
                            type="text"
                            name="venue"
                            value={search.venue}
                            onChange={handleSearchChange}
                            placeholder="Search by venue"
                            className="border rounded py-2 px-3"
                        />
                        <button
                            type="submit"
                            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Search
                        </button>
                    </div>
                </form>

                {events.length === 0 && (
                    <p>Aucun événement trouvé.</p>
                )}

                {events.map(event => (
                    <div key={event.id} className="bg-white rounded-lg shadow-md p-4 mb-4">
                        <h2 className="text-xl font-bold mb-2">{event.title}</h2>
                        {event.image && (
                            <img src={`/storage/${event.image}`} alt={event.title} className="mb-2" />
                        )}
                        <p className="text-gray-600 mb-2">{event.date}</p>
                        <p className="text-gray-600 mb-2">{event.venue.name}</p>
                        <p className="text-gray-600 mb-2">{event.city.name}</p>
                        <p className="mb-4">{event.description}</p>

                        <div className="flex justify-end space-x-2">
                            <Link
                                href={route('events.show', event.id)}
                                className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2"
                            >
                                View
                            </Link>
                            <Link
                                href={route('events.edit', event.id)}
                                className="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Edit
                            </Link>
                            <button
                                onClick={() => deleteEvent(event.id)}
                                className="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Delete
                            </button>
                        </div>
                    </div>
                ))}
            </div>
        </AuthenticatedLayout>
    );
}
