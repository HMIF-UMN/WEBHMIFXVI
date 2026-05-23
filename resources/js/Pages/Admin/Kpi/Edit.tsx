import AdminLayout from '@/Layouts/AdminLayout';
import { Head, Link } from '@inertiajs/react';

// TODO: receive kpiMember: KpiMember & { periods: KpiPeriod[] } from controller
export default function Edit() {
    return (
        <AdminLayout>
            <Head title="Edit KPI Member" />
            <div className="flex items-center gap-2 text-xs text-gray-500 mb-1">
                <Link href={route('admin.kpi.index')} className="hover:text-gray-300">KPI</Link>
                <span>›</span>
                <span className="text-gray-300">Edit</span>
            </div>
            <h1 className="text-2xl font-bold text-white mb-6">Edit KPI Member</h1>
            <div className="bg-[#1a1a1a] border border-gray-800 rounded-lg p-6 text-gray-400">
                {/* TODO: form to edit overall score and period scores */}
            </div>
        </AdminLayout>
    );
}
