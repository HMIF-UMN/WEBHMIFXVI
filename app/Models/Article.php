<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int         $id
 * @property string      $category
 * @property string      $title
 * @property \Illuminate\Support\Carbon $published_at
 * @property string      $image_path
 * @property string|null $image_alt
 * @property string      $excerpt
 * @property string      $content
 * @property bool        $is_published
 */
class Article extends Model
{
    public const CATEGORIES = ['BEASISWA', 'INFORMATION', 'EMPLOYMENT', 'OTHERS'];

    protected $fillable = [
        'category',
        'title',
        'published_at',
        'image_path',
        'image_alt',
        'excerpt',
        'content',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_published' => 'boolean',
    ];

    protected $appends = ['image_url', 'date'];

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }

    public function getDateAttribute(): string
    {
        return $this->published_at?->format('d F Y') ?? '';
    }
}
