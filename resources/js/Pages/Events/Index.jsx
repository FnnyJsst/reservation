import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import { useForm, Head } from '@inertiajs/react';
 
export default function Index({ auth }) {
    const { data, setData, post, processing, reset, errors } = useForm({
        message: '',
    });
 
    const submit = (e) => {
        e.preventDefault();
        post(route('events.store'), { onSuccess: () => reset() });
    };
 
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Events" />
 
            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <h1>All events</h1>
            </div>
        </AuthenticatedLayout>
    );
}