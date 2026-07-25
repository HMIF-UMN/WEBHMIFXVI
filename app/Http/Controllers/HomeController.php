<?php

namespace App\Http\Controllers;

use App\Models\SiteContent;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $heroImage = SiteContent::get('hero_image');

        return Inertia::render('Home', [
            'heroImage' => $heroImage ? "/storage/{$heroImage}" : null,
            'sections'  => [
                'about'     => SiteContent::get('section_about_visible',     'true') === 'true',
                'pojok_hmif'=> SiteContent::get('section_pojok_hmif_visible','true') === 'true',
                'proker'    => SiteContent::get('section_proker_visible',    'true') === 'true',
                'contact'   => SiteContent::get('section_contact_visible',   'true') === 'true',
            ],
        ]);
    }
}
