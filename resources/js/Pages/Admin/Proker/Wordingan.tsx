import { FormEventHandler } from 'react';
import AdminLayout from '@/Layouts/AdminLayout';
import { Head, useForm } from '@inertiajs/react';

// TODO: receive value: string from controller (site_content key: 'proker_wordingan')
export default function Wordingan({ wordingan }: { wordingan?: string }) {
    const { data, setData, patch, processing, errors } = useForm({
        value: wordingan,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault(); // Prevents the browser from doing a hard reload

        // Sends a PATCH request to the controller carrying the form data
        patch(route('admin.proker.wordingan.update'));
    };

    return (
        <AdminLayout>
            <Head title="Proker - Wordingan" />
            <h1 className="text-2xl font-bold text-white mb-6">Proker — Wordingan</h1>
            <div className="bg-[#1a1a1a] border border-gray-800 rounded-lg p-6 text-gray-400">
                <form onSubmit={submit} className="space-y-4">
                    <div>
                        <textarea
                            name="value"
                            value={data.value}
                            onChange={(e) => setData('value', e.target.value)}
                            rows={4}
                            className="w-full p-2 bg-gray-800 border border-gray-700 rounded text-white focus:ring-amber-500 focus:border-amber-500"
                            placeholder="Enter the proker wording text here..."
                        />

                        {errors.value && (
                            <p className="text-red-500 text-sm mt-1">{errors.value}</p>
                        )}
                    </div>

                    <button
                        type="submit"
                        disabled={processing}
                        className="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded transition-colors disabled:opacity-50"
                    >
                        {processing ? 'Updating...' : 'Update Wordingan Proker'}
                    </button>
                </form>
            </div>
        </AdminLayout>
    );
}
