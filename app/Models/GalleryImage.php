<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int         $id
 * @property string      $image_path
 * @property string|null $title
 * @property string|null $description
 * @property int         $order
 */
class GalleryImage extends Model
{
    protected $fillable = ['image_path', 'title', 'description', 'order'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}
