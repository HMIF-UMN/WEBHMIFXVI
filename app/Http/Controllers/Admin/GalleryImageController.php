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
            'images' => GalleryImage::orderBy('order')->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image'  => ['required', 'image', 'max:5120'],
            'title'  => ['nullable', 'string', 'max:100'],
            'order'  => ['nullable', 'integer', 'min:0'],
        ]);

        $path = $request->file('image')->store('gallery', 'uploads');

        GalleryImage::create([
            'image_path' => $path,
            'title'      => $request->title,
            'order'      => $request->order ?? 0,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Image uploaded.');
    }

    public function update(Request $request, GalleryImage $galleryImage): RedirectResponse
    {
        $request->validate([
            'title' => ['nullable', 'string', 'max:100'],
            'order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('uploads')->delete($galleryImage->image_path);
            $galleryImage->image_path = $request->file('image')->store('gallery', 'uploads');
        }

        $galleryImage->title = $request->title;
        $galleryImage->order = $request->order ?? $galleryImage->order;
        $galleryImage->save();

        return redirect()->route('admin.gallery.index')->with('success', 'Image updated.');
    }

    public function destroy(GalleryImage $galleryImage): RedirectResponse
    {
        Storage::disk('uploads')->delete($galleryImage->image_path);
        $galleryImage->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Image deleted.');
    }
}
