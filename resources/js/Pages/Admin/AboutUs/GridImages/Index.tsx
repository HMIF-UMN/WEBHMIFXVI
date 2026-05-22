import AdminLayout from '@/Layouts/AdminLayout';
import { Head } from '@inertiajs/react';

// TODO: receive aboutImages: AboutImage[] from controller
export default function Index() {
    return (
        <AdminLayout>
            <Head title="Grid Image" />
            <div className="flex items-center justify-between mb-6">
                <h1 className="text-2xl font-bold text-white">Grid Image</h1>
            </div>
            <div className="bg-[#1a1a1a] border border-gray-800 rounded-lg p-6 text-gray-400">
                {/* TODO: image grid with upload form and delete button per image */}
            </div>
        </AdminLayout>
    );
}
