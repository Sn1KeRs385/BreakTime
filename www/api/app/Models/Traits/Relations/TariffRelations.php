<?php

namespace App\Models\Traits\Relations;


use App\Models\Institution;
use App\Models\TariffTimer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait TariffRelations
{
    public function institution(): BelongsTo {
        return $this->belongsTo(Institution::class);
    }

    public function timers(): HasMany {
        return $this->hasMany(TariffTimer::class);
    }
}
