<?php

namespace App\Http\Controllers\Admin\Proker;

use App\Http\Controllers\Controller;
use App\Models\WorkProgram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class WorkProgramController extends Controller
{
    public function index(): Response
    {
        // TODO: return paginated work programs ordered by order column
        return Inertia::render('Admin/Proker/WorkPrograms/Index', [
            'work_programs' => WorkProgram::paginate(10),
        ]);
    }

    public function create(): Response
    {
        // TODO: return create form
        return Inertia::render('Admin/Proker/WorkPrograms/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: validate and create work program (handle logo upload)
    }

    public function show(WorkProgram $workProgram): Response
    {
        // TODO: return show form with work program data

        return Inertia::render('Admin/Proker/WorkPrograms/Show', [
            'work_program' => $workProgram,
        ]);
    }

    public function edit(WorkProgram $workProgram): Response
    {
        // TODO: return edit form with work program data
        return Inertia::render('Admin/Proker/WorkPrograms/Edit', [
            'work_program' => $workProgram,
        ]);
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
