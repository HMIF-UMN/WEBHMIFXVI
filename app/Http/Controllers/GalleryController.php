<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Inertia\Inertia;
use Inertia\Response;

class GalleryController extends Controller
{
    public function index(): Response
    {
        $photos = GalleryImage::orderBy('order')->orderBy('id')->get()
            ->map(fn(GalleryImage $img) => [
                'id'          => $img->id,
                'image_url'   => $img->image_url,
                'title'       => $img->title,
                'description' => $img->description,
            ]);

        return Inertia::render('Gallery', ['photos' => $photos]);
    }
}
