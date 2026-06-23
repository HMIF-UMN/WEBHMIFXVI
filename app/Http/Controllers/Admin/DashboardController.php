<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AspirationSubmission;
use App\Models\ContactSubmission;
use App\Models\CustomLink;
use App\Models\GalleryImage;
use App\Models\KpiMember;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $recentContact = ContactSubmission::latest()->limit(5)->get()
            ->map(fn($s) => [
                'id'         => $s->id,
                'name'       => $s->first_name . ' ' . $s->last_name,
                'message'    => $s->message,
                'read_at'    => $s->read_at,
                'created_at' => $s->created_at,
                'type'       => 'contact',
            ]);

        $recentAspiration = AspirationSubmission::latest()->limit(5)->get()
            ->map(fn($s) => [
                'id'         => $s->id,
                'name'       => $s->first_name . ' ' . $s->last_name,
                'message'    => $s->message,
                'read_at'    => $s->read_at,
                'created_at' => $s->created_at,
                'type'       => 'aspiration',
            ]);

        $recent = $recentContact->concat($recentAspiration)
            ->sortByDesc('created_at')
            ->values()
            ->take(5);

        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'unread_contact'    => ContactSubmission::whereNull('read_at')->count(),
                'unread_aspiration' => AspirationSubmission::whereNull('read_at')->count(),
                'gallery_photos'    => GalleryImage::count(),
                'kpi_members'       => KpiMember::count(),
                'custom_links'      => CustomLink::count(),
            ],
            'recent' => $recent,
        ]);
    }
}
