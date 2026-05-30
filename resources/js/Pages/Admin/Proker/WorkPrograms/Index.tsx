import AdminLayout from '@/Layouts/AdminLayout';
import { Head, Link } from '@inertiajs/react';
import type { WorkProgram } from '@/types';
import React from 'react';

interface PaginatedWorkPrograms {
    data: WorkProgram[];
    current_page: number;
    last_page: number;
    links: Array<{ url: string | null; label: string; active: boolean }>;
}

export default function Index({ work_programs }: { work_programs: WorkProgram[] | PaginatedWorkPrograms }) {
    // Safely parse out the raw array from paginated or standard collection structures
    const isPaginated = !Array.isArray(work_programs);
    const programArray = isPaginated
        ? (work_programs as PaginatedWorkPrograms).data
        : (work_programs as WorkProgram[]);

    return (
        <AdminLayout>
            <Head title="Work Programs" />

            {/* ── TOP ACTION BAR ── */}
            <div className="flex items-center justify-between mb-6">
                <h1 className="text-2xl font-bold text-white tracking-wide">Proker</h1>
                <Link
                    href={route('admin.proker.work-programs.create')}
                    className="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded shadow transition-colors inline-block"
                >
                    Create New Proker
                </Link>
            </div>

            {/* ── INITIATIVES LIST TABLE ── */}
            <div className="bg-[#1a1a1a] border border-gray-800 rounded-lg p-6 shadow-xl">
                <div className="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4 border-b border-gray-800/60 pb-2">
                    Badan Kerja & Inisiasi
                </div>

                {programArray.length === 0 ? (
                    <div className="py-12 text-center text-gray-500">
                        <p className="text-sm italic">No work programs found. Deploy a new initiative above.</p>
                    </div>
                ) : (
                    <>
                        <div className="overflow-x-auto">
                            <table className="w-full text-left border-collapse">
                                <thead>
                                    <tr className="border-b border-gray-800 text-xs text-gray-400 font-semibold tracking-wider">
                                        <th className="pb-3 w-16">Logo</th>
                                        <th className="pb-3">Name</th>
                                        <th className="pb-3 hidden md:table-cell">Catchphrase</th>
                                        <th className="pb-3 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-800/40 text-sm text-gray-300">
                                    {programArray.map((proker) => (
                                        <tr key={proker.id} className="hover:bg-white/[0.01] transition-colors">
                                            <td className="py-4 pr-4">
                                                <div className="w-10 h-10 rounded-md bg-black/30 border border-gray-800 p-1.5 flex items-center justify-center overflow-hidden">
                                                    {proker.logo_path ? (
                                                        <img src={`/storage/${proker.logo_path}`} alt="" className="object-contain w-full h-full" />
                                                    ) : (
                                                        <span className="text-[10px] text-gray-600">N/A</span>
                                                    )}
                                                </div>
                                            </td>
                                            <td className="py-4 font-medium text-white pr-4">
                                                {proker.title}
                                                <div className="text-[11px] text-gray-500 md:hidden mt-0.5">{proker.subtitle}</div>
                                            </td>
                                            <td className="py-4 text-gray-400 max-w-xs truncate hidden md:table-cell pr-4">
                                                {proker.subtitle}
                                            </td>
                                            <td className="py-4 text-right">
                                                <Link
                                                    href={route('admin.proker.work-programs.edit', proker.id)}
                                                    className="text-xs font-semibold text-amber-500 hover:text-amber-400 transition-colors bg-amber-500/5 hover:bg-amber-500/10 px-3 py-1.5 rounded border border-amber-500/20"
                                                >
                                                    Edit
                                                </Link>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>

                        {/* ── PAGINATION SYSTEM ── */}
                        {isPaginated && (work_programs as PaginatedWorkPrograms).links.length > 3 && (
                            <div className="flex flex-wrap items-center justify-center gap-1 mt-6 pt-4 border-t border-gray-800/60">
                                {(work_programs as PaginatedWorkPrograms).links.map((link, idx) => (
                                    <Link
                                        key={idx}
                                        href={link.url || '#'}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                        disabled={!link.url}
                                        className={`px-3 py-1.5 rounded text-xs transition-all ${link.active
                                                ? 'bg-amber-500 text-white font-medium'
                                                : link.url
                                                    ? 'bg-black/20 text-gray-400 hover:bg-black/40 hover:text-white'
                                                    : 'text-gray-600 cursor-not-allowed'
                                            }`}
                                    />
                                ))}
                            </div>
                        )}
                    </>
                )}
            </div>
        </AdminLayout>
    );
}
