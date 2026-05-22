<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkProgram extends Model
{
    protected $fillable = ['title', 'subtitle', 'description', 'logo_path', 'date', 'order'];

    protected $casts = ['date' => 'date'];
}
