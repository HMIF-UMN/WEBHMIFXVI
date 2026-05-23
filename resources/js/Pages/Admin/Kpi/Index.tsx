import AdminLayout from '@/Layouts/AdminLayout';
import { Head } from '@inertiajs/react';

// TODO: receive kpiMembers: PaginatedData<KpiMember & { periods: KpiPeriod[] }> from controller
export default function Index() {
    return (
        <AdminLayout>
            <Head title="KPI Members" />
            <h1 className="text-2xl font-bold text-white mb-6">KPI Members</h1>
            <div className="bg-[#1a1a1a] border border-gray-800 rounded-lg p-6 text-gray-400">
                {/* TODO: table of KPI members with overall score and edit button */}
            </div>
        </AdminLayout>
    );
}
