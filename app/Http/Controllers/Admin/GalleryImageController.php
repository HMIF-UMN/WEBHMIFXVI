<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class GalleryImageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Gallery/Index', [
            'images' => GalleryImage::orderBy('order')->orderBy('id')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image'       => ['required', 'image', 'max:8192'],
            'title'       => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $path = $request->file('image')->store('gallery', 'public');
        $nextOrder = GalleryImage::max('order') + 1;

        GalleryImage::create([
            'image_path'  => $path,
            'title'       => $request->title ?: null,
            'description' => $request->description ?: null,
            'order'       => $nextOrder,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Image uploaded.');
    }

    public function update(Request $request, GalleryImage $galleryImage): RedirectResponse
    {
        $request->validate([
            'title'       => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'image'       => ['nullable', 'image', 'max:8192'],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($galleryImage->image_path);
            $galleryImage->image_path = $request->file('image')->store('gallery', 'public');
        }

        $galleryImage->title       = $request->title ?: null;
        $galleryImage->description = $request->description ?: null;
        $galleryImage->save();

        return redirect()->route('admin.gallery.index')->with('success', 'Image updated.');
    }

    public function destroy(GalleryImage $galleryImage): RedirectResponse
    {
        Storage::disk('public')->delete($galleryImage->image_path);
        $galleryImage->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Image deleted.');
    }
}
