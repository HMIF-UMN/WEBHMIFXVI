<?php

namespace App\Http\Controllers\Admin\AboutUs;

use App\Http\Controllers\Controller;
use App\Models\AboutImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AboutImageController extends Controller
{
    public function index(): Response
    {
        // TODO: return all about images ordered by order column
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: validate image upload, store file, create record
    }

    public function destroy(AboutImage $aboutImage): RedirectResponse
    {
        // TODO: delete record and remove image file
    }
}
