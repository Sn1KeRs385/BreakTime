<?php

namespace App\Models\Traits\Relations;

use App\Models\AccessType;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait AccessRelations
{
    public function type(): BelongsTo {
        return $this->belongsTo(AccessType::class);
    }

    public function institution(): BelongsTo {
        return $this->belongsTo(Institution::class);
    }
}
