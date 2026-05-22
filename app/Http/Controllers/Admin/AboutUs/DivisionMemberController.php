<?php

namespace App\Http\Controllers\Admin\AboutUs;

use App\Http\Controllers\Controller;
use App\Models\DivisionMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DivisionMemberController extends Controller
{
    public function index(): Response
    {
        // TODO: return all division members grouped by division, ordered by order column
    }

    public function create(): Response
    {
        // TODO: return create form with available division options
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: validate and create division member (handle image upload)
    }

    public function edit(DivisionMember $divisionMember): Response
    {
        // TODO: return edit form with member data
    }

    public function update(Request $request, DivisionMember $divisionMember): RedirectResponse
    {
        // TODO: validate and update (handle image replacement)
    }

    public function destroy(DivisionMember $divisionMember): RedirectResponse
    {
        // TODO: delete member (and remove image file)
    }
}
