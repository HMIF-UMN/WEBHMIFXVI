<?php

namespace App\Http\Controllers\Admin\AboutUs;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class WordinganController extends Controller
{
    public function edit(): Response
    {
        $content = SiteContent::get('about_wordingan', '');
        
        return Inertia::render('Admin/AboutUs/Wordingan', [
            'content' => $content,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        SiteContent::set('about_wordingan', $validated['content']);

        return redirect()->route('admin.about-us.wordingan.edit')
            ->with('success', 'Wordingan updated successfully');
    }
}
