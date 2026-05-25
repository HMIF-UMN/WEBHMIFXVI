<?php

namespace App\Http\Controllers\Admin\AboutUs;

use App\Http\Controllers\Controller;
use App\Models\DivisionMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Storage;

class DivisionMemberController extends Controller
{
    private const DIVISIONS = [
        'Project Manager',
        'Creative',
        'Finance',
        'Research and Development',
        'Human Resource',
        'Public Relation',
        'Badan Pengurus Harian',
    ];

    public function index(): Response
    {
        $members = DivisionMember::orderBy('order')->get();
        $grouped = $members->groupBy('division')->toArray();
        
        return Inertia::render('Admin/AboutUs/DivisionMembers/Index', [
            'grouped' => $grouped,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/AboutUs/DivisionMembers/Create', [
            'divisions' => self::DIVISIONS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'division' => 'required|in:' . implode(',', self::DIVISIONS),
            'role_title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('division-members', 'public');
        }

        $order = DivisionMember::where('division', $validated['division'])->max('order') ?? 0;
        $validated['order'] = $order + 1;

        DivisionMember::create($validated);

        return redirect()->route('admin.about-us.division-members.index')
            ->with('success', 'Division member added successfully');
    }

    public function edit(DivisionMember $divisionMember): Response
    {
        return Inertia::render('Admin/AboutUs/DivisionMembers/Edit', [
            'member' => $divisionMember,
            'divisions' => self::DIVISIONS,
        ]);
    }

    public function update(Request $request, DivisionMember $divisionMember): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'division' => 'required|in:' . implode(',', self::DIVISIONS),
            'role_title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($divisionMember->image_path) {
                Storage::disk('public')->delete($divisionMember->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('division-members', 'public');
        }

        $divisionMember->update($validated);

        return redirect()->route('admin.about-us.division-members.index')
            ->with('success', 'Division member updated successfully');
    }

    public function destroy(DivisionMember $divisionMember): RedirectResponse
    {
        if ($divisionMember->image_path) {
            Storage::disk('public')->delete($divisionMember->image_path);
        }

        $divisionMember->delete();

        return redirect()->route('admin.about-us.division-members.index')
            ->with('success', 'Division member deleted successfully');
    }
}
