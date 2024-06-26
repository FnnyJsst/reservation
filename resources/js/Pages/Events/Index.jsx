import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

export default function Index({ auth, events }) {

    console.log(events);

    if (!Array.isArray(events)) {
        events = [];
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

                {events.length === 0 && (
                    <p>Aucun événement trouvé.</p>
                )}

                {events.map(event => (
                    <div key={event.id} className="bg-white rounded-lg shadow-md p-4 mb-4">
                        <h2 className="text-xl font-bold mb-2">{event.title}</h2>
                        {/* Additional fields */}
                        <p className="text-gray-600 mb-2">{event.date}</p>
                        <p className="text-gray-600 mb-2">{event.venue.name}</p>
                        <p className="text-gray-600 mb-2">{event.city.name}</p>
                        <p className="mb-4">{event.description}</p>

                        <div className="flex justify-end">
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
                        </div>
                    </div>
                ))}
            </div>
        </AuthenticatedLayout>
    );
}
