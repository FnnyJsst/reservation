import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

export default function Show({ auth, event }) {

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={`Event ${event.title}`} />

            {event ? (
                <div className="max-w-xl mx-auto bg-white rounded-xl shadow-md p-4 mb-4 mt-8">
                    <h2 className="text-xl font-bold mb-2">{event.title}</h2>
                    <h2 className="text-xl font-bold mb-2">{event.artists}</h2>
                    <p className="text-gray-600 mb-2">{event.date}</p>
                    <p className="text-gray-600 mb-2">{event.venue.name}</p>
                    <p className="text-gray-600 mb-2">{event.city.name}</p>
                    <p className="mb-4">{event.description}</p>
                    <Link href={route('events.index')} className="bg-slate-400 hover:bg-slate-500 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </Link>
                </div>

            ) : (
                <p className="text-center mt-8">Aucun événement trouvé.</p>
            )}
        </AuthenticatedLayout>
    );
}
