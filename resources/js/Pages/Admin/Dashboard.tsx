import AdminLayout from '@/Layouts/AdminLayout';
import { Head } from '@inertiajs/react';

export default function Dashboard() {
    return (
        <AdminLayout>
            <Head title="Dashboard" />
            <h1 className="text-2xl font-bold text-white mb-6">Dashboard</h1>
            <div className="bg-[#1a1a1a] border border-gray-800 rounded-lg p-6 text-gray-400">
                Welcome to the HMIF admin panel.
            </div>
        </AdminLayout>
    );
}
