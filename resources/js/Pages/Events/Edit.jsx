import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function EditEvent({ auth, event, venues, cities }) {
    
    const { data, setData, patch, errors } = useForm({
        title: event.title,
        date: event.date,
        venue_id: event.venue_id,
        city_id: event.city_id,
        description: event.description,
        artists: event.artists
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        patch(route('events.update', event.id), {
            onSuccess: () => {
                // Handle success if needed
            },
            onError: () => {
                // Handle error if needed
            }
        });
    };

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title={`Edit ${event.title}`} />

            <div className="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-4 mb-4 mt-8">
                <h1 className="text-2xl font-bold mb-4">Edit Event</h1>

                <form onSubmit={handleSubmit}>
                    <div className="mb-4">
                        <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="title">
                            Title
                        </label>
                        <input 
                            type="text"
                            id="title"
                            value={data.title}
                            onChange={e => setData('title', e.target.value)}
                            className="shadow appearance-none border-gray rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        />
                        {errors.title && <p className="text-red-500 text-xs italic">{errors.title}</p>}
                    </div>

                    <div className="mb-4">
                        <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="artist">
                            Artist
                        </label>
                        <input 
                            type="text"
                            id="artist"
                            value={data.artists}
                            onChange={e => setData('artists', e.target.value)}
                            className="shadow appearance-none border-gray rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        />
                        {errors.artists && <p className="text-red-500 text-xs italic">{errors.artists}</p>}
                    </div>

                    <div className="mb-4">
                        <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="date">
                            Date
                        </label>
                        <input 
                            type="date"
                            id="date"
                            value={data.date}
                            onChange={e => setData('date', e.target.value)}
                            className="shadow appearance-none border-gray rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        />
                        {errors.date && <p className="text-red-500 text-xs italic">{errors.date}</p>}
                    </div>

                    <div className="mb-4">
                        <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="venue">
                            Venue
                        </label>
                        <select name="venue_id" id="venue" 
                            value={data.venue_id}
                            onChange={e => setData('venue_id', e.target.value)}
                            className="shadow appearance-none border-gray rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select a venue</option>
                            {venues.map(venue => (
                                <option key={venue.id} value={venue.id}>{venue.name}</option>
                            ))}
                        </select>
                        {errors.venue_id && <p className="text-red-500 text-xs italic">{errors.venue_id}</p>}
                    </div>

                    <div className="mb-4">
                        <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="description">
                            Description
                        </label>
                        <textarea 
                            id="description"
                            value={data.description}
                            onChange={e => setData('description', e.target.value)}
                            className="shadow appearance-none border-gray rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        />
                        {errors.description && <p className="text-red-500 text-xs italic">{errors.description}</p>}
                    </div>

                    <div className="flex items-center justify-between">
                        <button 
                            type="submit"
                            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Event
                        </button>
                        <Link href={route('events.index')} className="inline-block align-baseline font-bold text-sm text-black-500 hover:text--800">
                            Cancel
                        </Link>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
