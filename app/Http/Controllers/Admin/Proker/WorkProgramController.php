<?php

namespace App\Http\Controllers\Admin\Proker;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
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
        $workPrograms = WorkProgram::with('images')
            ->paginate(10);

        return Inertia::render('Admin/Proker/WorkPrograms/Index', [
            'work_programs' => $workPrograms,
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'date_start' => 'nullable|date',
            'date_end' => 'nullable|date|after_or_equal:date_start',
            'logo_path' => 'nullable|file|mimes:svg,png,jpg,jpeg|max:2048',
            'image_paths' => 'nullable|array',
            'image_paths.*' => 'file|image|mimes:svg,png,jpg,jpeg|max:5120', // 5MB max per image
        ]);

        // 2. Handle the single Logo upload
        if ($request->hasFile('logo_path')) {
            // Stores the file in storage/app/public/work-programs/logos
            $validated['logo_path'] = $request->file('logo_path')->store('work-programs/logos', 'public');
        }

        $workProgram = WorkProgram::create($validated);

        // 4. Handle Multiple Carousel Images (if any were uploaded)
        if ($request->hasFile('image_paths')) {
            $imagesData = [];

            foreach ($request->file('image_paths') as $file) {
                // Store each image
                $path = $file->store('work-programs/gallery', 'public');

                // Prepare the related model instances
                $imagesData[] = new WorkProgramImages([
                    'image_path' => $path, // Note: change 'image_path' if your column is named differently (e.g., 'path' or 'url')
                ]);
            }

            // Save all related images at once using the relationship
            if (! empty($imagesData)) {
                $workProgram->images()->saveMany($imagesData);
            }
        }

        // 5. Redirect back to the Index page
        return redirect()->route('admin.proker.work-programs.index')
            ->with('success', 'Work program created successfully.');
    }

    public function show(WorkProgram $workProgram): Response
    {
        // TODO: return show form with work program data
        $workProgram->load('images');

        return Inertia::render('WorkProgram', [
            'wordingan' => SiteContent::get('proker_wordingan'),
            'work_program' => $workProgram,
        ]);
    }

    public function edit(WorkProgram $workProgram): Response
    {
        // TODO: return edit form with work program data
        $workProgram->load('images');

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
