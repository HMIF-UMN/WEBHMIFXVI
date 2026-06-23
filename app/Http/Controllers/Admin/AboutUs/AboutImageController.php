<?php

namespace App\Http\Controllers\Admin\AboutUs;

use App\Http\Controllers\Controller;
use App\Models\AboutImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Storage;

class AboutImageController extends Controller
{   
    public function index(): Response
    {
        $images = AboutImage::orderBy('order')->get();
        
        return Inertia::render('Admin/AboutUs/GridImages/Index', [
            'images' => $images,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $validated['image_path'] = $request->file('image')->store('about-images', 'public');
        $order = AboutImage::max('order') ?? 0;
        $validated['order'] = $order + 1;

        AboutImage::create($validated);

        return redirect()->route('admin.about-us.grid-images.index')
            ->with('success', 'Image uploaded successfully');
    }

    public function destroy(AboutImage $aboutImage): RedirectResponse
    {
        Storage::disk('public')->delete($aboutImage->image_path);
        $aboutImage->delete();

        return redirect()->route('admin.about-us.grid-images.index')
            ->with('success', 'Image deleted successfully');
    }
}
