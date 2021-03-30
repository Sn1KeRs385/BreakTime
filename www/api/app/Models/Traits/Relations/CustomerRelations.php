<?php

namespace App\Models\Traits\Relations;


use App\Models\CustomerUser;
use App\Models\Institution;
use App\Models\Place;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait CustomerRelations
{
    public function institution(): BelongsTo {
        return $this->belongsTo(Institution::class);
    }

    public function place(): BelongsTo {
        return $this->belongsTo(Place::class);
    }

    public function customerUsers(): HasMany {
        return $this->hasMany(CustomerUser::class);
    }
}
