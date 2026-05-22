import AdminLayout from '@/Layouts/AdminLayout';
import { Head, Link } from '@inertiajs/react';

// TODO: receive navbarButtons: NavbarButton[] from controller
export default function Index() {
    return (
        <AdminLayout>
            <Head title="Navbar Buttons" />
            <div className="flex items-center justify-between mb-6">
                <h1 className="text-2xl font-bold text-white">Button Navbar</h1>
                <Link
                    href={route('admin.navbar-buttons.create')}
                    className="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded transition-colors"
                >
                    New Button
                </Link>
            </div>
            <div className="bg-[#1a1a1a] border border-gray-800 rounded-lg p-6 text-gray-400">
                {/* TODO: table of navbar buttons with label, url, active toggle, reorder, edit, delete */}
            </div>
        </AdminLayout>
    );
}
