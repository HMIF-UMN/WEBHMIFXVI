<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class HomeSettingsController extends Controller
{
    public function edit(): Response
    {
        $heroImage = SiteContent::get('hero_image');

        return Inertia::render('Admin/Home/Settings', [
            'heroImage' => $heroImage ? "/uploads/{$heroImage}" : null,
            'sections'  => [
                'about'      => SiteContent::get('section_about_visible',     'true') === 'true',
                'pojok_hmif' => SiteContent::get('section_pojok_hmif_visible','true') === 'true',
                'proker'     => SiteContent::get('section_proker_visible',    'true') === 'true',
                'contact'    => SiteContent::get('section_contact_visible',   'true') === 'true',
            ],
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        foreach (['about', 'pojok_hmif', 'proker', 'contact'] as $section) {
            SiteContent::set(
                "section_{$section}_visible",
                $request->boolean("section_{$section}") ? 'true' : 'false'
            );
        }

        return redirect()->back()->with('success', 'Section visibility updated.');
    }

    public function updateHero(Request $request): RedirectResponse
    {
        $request->validate(['image' => ['required', 'image', 'max:8192']]);

        $old = SiteContent::get('hero_image');
        if ($old) {
            Storage::disk('uploads')->delete($old);
        }

        $path = $request->file('image')->store('home', 'uploads');
        SiteContent::set('hero_image', $path);

        return redirect()->back()->with('success', 'Hero image updated.');
    }
}
