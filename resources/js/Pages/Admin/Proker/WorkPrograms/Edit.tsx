import AdminLayout from '@/Layouts/AdminLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import React from 'react';

export default function Create() {
    // Inertia Form Setup handling primary inputs & multiple photo storage pools
    const { data, setData, post, processing, errors } = useForm({
        title: '',
        subtitle: '',
        description: '',
        logo_path: null as File | null,
        date_start: '',
        date_end: '',
        image_paths: [] as File[],
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('admin.proker.work-programs.store'));
    };

    const handleMultipleImages = (e: React.ChangeEvent<HTMLInputElement>) => {
        if (e.target.files) {
            setData('image_paths', Array.from(e.target.files));
        }
    };

    return (
        <AdminLayout>
            <Head title="Create Work Program" />

            {/* ── BACK TRACKING HEADER ── */}
            <div className="mb-6">
                <Link
                    href={route('admin.proker.work-programs.index')}
                    className="text-xs text-gray-500 hover:text-amber-500 transition-colors flex items-center gap-1"
                >
                    ← Back to Dashboard
                </Link>
                <h1 className="text-2xl font-bold text-white tracking-wide mt-2">Create Work Program</h1>
            </div>

            {/* ── CREATION CARD SURFACE ── */}
            <div className="bg-[#1a1a1a] border border-gray-800 rounded-lg p-6 max-w-3xl shadow-xl">
                <form onSubmit={handleSubmit} className="space-y-6 text-gray-300">

                    {/* Title */}
                    <div>
                        <label className="block text-xs font-semibold uppercase text-gray-400 mb-2">Program Title</label>
                        <input
                            type="text"
                            value={data.title}
                            onChange={e => setData('title', e.target.value)}
                            className="w-full bg-[#111111] border border-gray-800 rounded px-4 py-2.5 text-white text-sm focus:outline-none focus:border-amber-500 transition-colors"
                            placeholder="e.g., Perkenalan Prodi Informatika"
                            required
                        />
                        {errors.title && <p className="text-xs text-rose-500 mt-1">{errors.title}</p>}
                    </div>

                    {/* Subtitle */}
                    <div>
                        <label className="block text-xs font-semibold uppercase text-gray-400 mb-2">Subtitle / Short Catchphrase</label>
                        <input
                            type="text"
                            value={data.subtitle}
                            onChange={e => setData('subtitle', e.target.value)}
                            className="w-full bg-[#111111] border border-gray-800 rounded px-4 py-2.5 text-white text-sm focus:outline-none focus:border-amber-500 transition-colors"
                            placeholder="e.g., Adapt & Learn"
                            required
                        />
                        {errors.subtitle && <p className="text-xs text-rose-500 mt-1">{errors.subtitle}</p>}
                    </div>

                    {/* Timelines row */}
                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label className="block text-xs font-semibold uppercase text-gray-400 mb-2">Date Start</label>
                            <input
                                type="date"
                                value={data.date_start}
                                onChange={e => setData('date_start', e.target.value)}
                                className="w-full bg-[#111111] border border-gray-800 rounded px-3 py-2 text-white text-sm focus:outline-none focus:border-amber-500"
                            />
                            {errors.date_start && <p className="text-xs text-rose-500 mt-1">{errors.date_start}</p>}
                        </div>
                        <div>
                            <label className="block text-xs font-semibold uppercase text-gray-400 mb-2">Date End</label>
                            <input
                                type="date"
                                value={data.date_end}
                                onChange={e => setData('date_end', e.target.value)}
                                className="w-full bg-[#111111] border border-gray-800 rounded px-3 py-2 text-white text-sm focus:outline-none focus:border-amber-500"
                            />
                            {errors.date_end && <p className="text-xs text-rose-500 mt-1">{errors.date_end}</p>}
                        </div>
                    </div>

                    {/* File Upload Fields */}
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                        {/* Vector Logo */}
                        <div>
                            <label className="block text-xs font-semibold uppercase text-gray-400 mb-2">Logo SVG / PNG</label>
                            <input
                                type="file"
                                accept=".svg,.png,.jpg"
                                onChange={e => setData('logo_path', e.target.files ? e.target.files[0] : null)}
                                className="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-gray-800 file:text-gray-300 file:hover:bg-gray-700 cursor-pointer"
                            />
                            {errors.logo_path && <p className="text-xs text-rose-500 mt-1">{errors.logo_path}</p>}
                        </div>

                        {/* Carousel Photos Gallery */}
                        <div>
                            <label className="block text-xs font-semibold uppercase text-gray-400 mb-2">Carousel Showcase Images</label>
                            <input
                                type="file"
                                multiple
                                accept="image/*"
                                onChange={handleMultipleImages}
                                className="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-gray-800 file:text-gray-300 file:hover:bg-gray-700 cursor-pointer"
                            />
                            <p className="text-[10px] text-gray-500 mt-1">
                                {data.image_paths.length > 0 ? `${data.image_paths.length} photos staged` : 'Upload gallery compilation files'}
                            </p>
                        </div>
                    </div>

                    {/* Description Textarea */}
                    <div>
                        <label className="block text-xs font-semibold uppercase text-gray-400 mb-2">Comprehensive Description</label>
                        <textarea
                            rows={5}
                            value={data.description}
                            onChange={e => setData('description', e.target.value)}
                            className="w-full bg-[#111111] border border-gray-800 rounded px-4 py-2 text-white text-sm focus:outline-none focus:border-amber-500 resize-none custom-scrollbar"
                            placeholder="Provide a detailed program outline, key objectives, target audience, and event schedule details..."
                            required
                        />
                        {errors.description && <p className="text-xs text-rose-500 mt-1">{errors.description}</p>}
                    </div>

                    {/* Action Triggers */}
                    <div className="pt-4 flex items-center justify-end gap-3 border-t border-gray-800">
                        <Link
                            href={route('admin.proker.work-programs.index')}
                            className="px-4 py-2 rounded text-sm font-medium text-gray-400 hover:text-white transition-colors"
                        >
                            Cancel
                        </Link>
                        <button
                            type="submit"
                            disabled={processing}
                            className="px-5 py-2 rounded text-sm font-medium bg-amber-500 hover:bg-amber-600 text-white disabled:bg-gray-800 disabled:text-gray-600 transition-colors shadow-lg cursor-pointer"
                        >
                            {processing ? 'Processing Transfer...' : 'Deploy Work Program'}
                        </button>
                    </div>
                </form>
            </div>
        </AdminLayout>
    );
}
