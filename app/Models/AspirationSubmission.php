<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirationSubmission extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'message', 'read_at'];
}
