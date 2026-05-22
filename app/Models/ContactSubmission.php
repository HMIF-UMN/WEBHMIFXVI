<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'message', 'read_at'];

    protected $casts = ['read_at' => 'datetime'];

    public function isRead(): bool
    {
        return $this->read_at !== null;
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
