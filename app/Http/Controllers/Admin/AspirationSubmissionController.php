<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AspirationSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;
use Inertia\Response;

class AspirationSubmissionController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/AspirationSubmissions/Index', [
            'submissions' => AspirationSubmission::latest()->paginate(20),
            'unreadCount' => AspirationSubmission::whereNull('read_at')->count(),
        ]);
    }

    public function markRead(AspirationSubmission $aspirationSubmission): RedirectResponse
    {
        $aspirationSubmission->update(['read_at' => Date::now()]);

        return redirect()->back();
    }

    public function destroy(AspirationSubmission $aspirationSubmission): RedirectResponse
    {
        $aspirationSubmission->delete();

        return redirect()->back()->with('success', 'Submission deleted.');
    }
}
