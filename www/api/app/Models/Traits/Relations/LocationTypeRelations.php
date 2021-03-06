<?php

namespace App\Models\Traits\Relations;


use App\Models\Location;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait LocationTypeRelations
{
    public function locations(): HasMany {
        return $this->hasMany(Location::class);
    }
}
