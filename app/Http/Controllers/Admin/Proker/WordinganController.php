<?php

namespace App\Http\Controllers\Admin\Proker;

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
        // TODO: return edit form with current value of site_content key 'proker_wordingan'
        return Inertia::render('Admin/Proker/Wordingan', [
            'wordingan' => SiteContent::get('proker_wordingan'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        // TODO: validate and call SiteContent::set('proker_wordingan', $request->value)
        $request->validate([
            'value' => 'required|string',
        ]);

        SiteContent::set('proker_wordingan', $request->value);

        return redirect()->back()->with('success', 'Wordingan updated successfully.');
    }
}
