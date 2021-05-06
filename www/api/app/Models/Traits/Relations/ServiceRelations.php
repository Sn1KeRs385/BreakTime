<?php

namespace App\Models\Traits\Relations;


use App\Models\Institution;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ServiceRelations
{
    public function institution(): BelongsTo {
        return $this->belongsTo(Institution::class);
    }
}
