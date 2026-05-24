<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkProgram extends Model
{
    protected $fillable = ['title', 'subtitle', 'description', 'logo_path', 'date_start', 'date_end'];

    protected $casts = ['date_start' => 'date', 'date_end' => 'date'];
}
