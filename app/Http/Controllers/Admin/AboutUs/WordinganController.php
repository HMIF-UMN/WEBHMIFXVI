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
        // TODO: return edit form with current value of site_content key 'about_wordingan'
    }

    public function update(Request $request): RedirectResponse
    {
        // TODO: validate and call SiteContent::set('about_wordingan', $request->value)
    }
}
