<?php

namespace App\Models\Traits\Relations;


use App\Models\Tariff;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TariffTimerRelations
{
    public function tariff(): BelongsTo {
        return $this->belongsTo(Tariff::class);
    }
}
