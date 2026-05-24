<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkProgramImages extends Model
{
    protected $fillable = ['work_program_id', 'image_path'];

    protected $casts = ['work_program_id' => 'integer'];
}
