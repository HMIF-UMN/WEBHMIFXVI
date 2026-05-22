<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;
use Inertia\Response;

class ContactSubmissionController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/ContactSubmissions/Index', [
            'submissions' => ContactSubmission::latest()->paginate(20),
            'unreadCount' => ContactSubmission::whereNull('read_at')->count(),
        ]);
    }

    public function markRead(ContactSubmission $contactSubmission): RedirectResponse
    {
        $contactSubmission->update(['read_at' => Date::now()]);

        return redirect()->back();
    }

    public function destroy(ContactSubmission $contactSubmission): RedirectResponse
    {
        $contactSubmission->delete();

        return redirect()->back()->with('success', 'Submission deleted.');
    }
}
