<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CustomLinkController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/CustomLinks/Index', [
            'customLinks' => CustomLink::latest()->paginate(10),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/CustomLinks/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'slug'            => ['required', 'string', 'max:100', 'unique:custom_links,slug', 'regex:/^[a-zA-Z0-9_-]+$/'],
            'destination_url' => ['required', 'url', 'max:2048'],
            'label'           => ['nullable', 'string', 'max:100'],
        ]);

        CustomLink::create($validated);

        return redirect()->route('admin.custom-links.index')->with('success', 'Custom link created.');
    }

    public function edit(CustomLink $customLink): Response
    {
        return Inertia::render('Admin/CustomLinks/Edit', [
            'customLink' => $customLink,
        ]);
    }

    public function update(Request $request, CustomLink $customLink): RedirectResponse
    {
        $validated = $request->validate([
            'slug'            => ['required', 'string', 'max:100', 'unique:custom_links,slug,' . $customLink->id, 'regex:/^[a-zA-Z0-9_-]+$/'],
            'destination_url' => ['required', 'url', 'max:2048'],
            'label'           => ['nullable', 'string', 'max:100'],
        ]);

        $customLink->update($validated);

        return redirect()->route('admin.custom-links.index')->with('success', 'Custom link updated.');
    }

    public function destroy(CustomLink $customLink): RedirectResponse
    {
        $customLink->delete();

        return redirect()->route('admin.custom-links.index')->with('success', 'Custom link deleted.');
    }

    public function redirect(string $slug): RedirectResponse
    {
        $link = CustomLink::where('slug', $slug)->firstOrFail();

        return redirect($link->destination_url, 301);
    }
}
