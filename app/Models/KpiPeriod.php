<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KpiPeriod extends Model
{
    protected $fillable = ['kpi_member_id', 'period_name', 'score'];

    public function member(): BelongsTo
    {
        return $this->belongsTo(KpiMember::class, 'kpi_member_id');
    }
}
