<?php

namespace App\Models\Traits\Relations;


use App\Models\Access;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait AccessTypeRelations
{
    public function accesses(): HasMany {
        return $this->hasMany(Access::class);
    }
}
