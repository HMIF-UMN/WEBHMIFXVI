<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomLink extends Model
{
    protected $fillable = ['slug', 'destination_url', 'label'];
}
