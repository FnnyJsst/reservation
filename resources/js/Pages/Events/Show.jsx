import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Show({ auth, event }) {

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={`Event ${event.title}`} />

                {event && (
                    <div key={event.id} className="bg-white rounded-lg shadow-md p-4 mb-4">
                        <h2 className="text-xl font-bold mb-2">{event.title}</h2>
                        <h2 className="text-xl font-bold mb-2">{event.artists}</h2>
                        <p className="text-gray-600 mb-2">{event.date}</p>
                        <p className="text-gray-600 mb-2">{event.venue.name}</p>
                        <p className="text-gray-600 mb-2">{event.city.name}</p>
                        <p className="mb-4">{event.description}</p>
                        
                    </div>
                )}

                {!event && (
                    <p>Aucun événement trouvé.</p>
                )}
            
        </AuthenticatedLayout>
    );
}
