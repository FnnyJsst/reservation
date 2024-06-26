import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

export default function Index({ auth, events }) {

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

                {events.map(event => (
                    <Link key={event.id} href={route('events.show', event.id)} className="block mb-4">
                        <div key={event.id} className="bg-white rounded-lg shadow-md p-4 mb-4">
                            <h2 className="text-xl font-bold mb-2">{event.title}</h2>
                            <p className="text-gray-600 mb-2">{event.date}</p>
                            <p className="text-gray-600 mb-2">{event.venue}</p>
                            <p className="text-gray-600 mb-2">{event.city}</p>
                            <p className="mb-4">{event.description}</p>
                        </div>
                    </Link>
                ))}

                {events.length === 0 && (
                    <p>Aucun événement trouvé.</p>
                )}
            </div>
        </AuthenticatedLayout>
    );
}
