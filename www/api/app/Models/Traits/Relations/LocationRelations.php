<?php

namespace App\Models\Traits\Relations;


use App\Models\Location;
use App\Models\LocationType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait LocationRelations
{
    public function parent(): BelongsTo {
        return $this->belongsTo(Location::class);
    }

    public function type(): BelongsTo {
        return $this->belongsTo(LocationType::class);
    }
}
