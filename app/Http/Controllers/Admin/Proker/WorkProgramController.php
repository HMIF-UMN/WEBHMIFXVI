<?php

namespace App\Http\Controllers\Admin\Proker;

use App\Http\Controllers\Controller;
use App\Models\WorkProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class WorkProgramController extends Controller
{
    public function index(): Response
    {
        // TODO: return paginated work programs ordered by order column
        return Inertia::render('Admin/Proker/Inertia', [
            'work_programs' => WorkProgram::orderBy('order')->get(),
        ]);
    }

    public function create(): Response
    {
        // TODO: return create form
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: validate and create work program (handle logo upload)
    }

    public function edit(WorkProgram $workProgram): Response
    {
        // TODO: return edit form with work program data
    }

    public function update(Request $request, WorkProgram $workProgram): RedirectResponse
    {
        // TODO: validate and update (handle logo replacement)
    }

    public function destroy(WorkProgram $workProgram): RedirectResponse
    {
        // TODO: delete work program (and remove logo file)
    }
}
