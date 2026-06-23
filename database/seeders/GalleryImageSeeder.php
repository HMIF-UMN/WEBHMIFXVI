<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class GalleryImageSeeder extends Seeder
{
    public function run(): void
    {
        $photos = [
            ['title' => 'Perkenalan Prodi Informatika',  'description' => 'Sesi perkenalan program studi Informatika UMN bersama seluruh anggota HMIF XVI.'],
            ['title' => 'Rapat Koordinasi Divisi',        'description' => 'Rapat rutin koordinasi antar divisi HMIF XVI untuk menyelaraskan program kerja.'],
            ['title' => 'Kegiatan Bersama HMIF XVI',     'description' => 'Momen kebersamaan pengurus HMIF XVI dalam menjalankan kegiatan himpunan.'],
            ['title' => 'Pelantikan Pengurus',            'description' => 'Pelantikan resmi pengurus Himpunan Mahasiswa Informatika UMN periode XVI.'],
            ['title' => 'Workshop & Seminar',             'description' => 'Kegiatan workshop dan seminar yang diselenggarakan oleh HMIF XVI untuk mahasiswa Informatika.'],
            ['title' => 'Open Recruitment HMIF XVI',      'description' => 'Proses open recruitment untuk calon pengurus baru HMIF XVI.'],
            ['title' => 'Evaluasi Program Kerja',         'description' => 'Sesi evaluasi dan refleksi program kerja HMIF XVI bersama seluruh pengurus.'],
            ['title' => 'Dokumentasi Kegiatan',           'description' => 'Dokumentasi berbagai kegiatan dan momen berkesan HMIF XVI sepanjang periode kepengurusan.'],
        ];

        $destDir = public_path('uploads/gallery');
        if (! File::exists($destDir)) {
            File::makeDirectory($destDir, 0755, true);
        }

        GalleryImage::truncate();

        foreach ($photos as $order => $meta) {
            $filename = ($order + 1) . '.webp';
            $srcPath  = public_path("images/{$filename}");
            $destPath = "{$destDir}/{$filename}";

            if (File::exists($srcPath)) {
                File::copy($srcPath, $destPath);
            }

            GalleryImage::create([
                'image_path'  => "gallery/{$filename}",
                'title'       => $meta['title'],
                'description' => $meta['description'],
                'order'       => $order,
            ]);
        }
    }
}
