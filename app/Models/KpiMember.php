<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property string $name
 * @property string $division
 * @property int    $overall
 */
class KpiMember extends Model
{
    protected $fillable = ['name', 'division', 'overall'];

    public function periods(): HasMany
    {
        return $this->hasMany(KpiPeriod::class);
    }
}
