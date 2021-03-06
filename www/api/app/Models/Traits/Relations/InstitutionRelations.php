<?php

namespace App\Models\Traits\Relations;


use App\Models\Access;
use App\Models\InstitutionUser;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait InstitutionRelations
{
    public function location(): BelongsTo {
        return $this->belongsTo(Location::class);
    }

    public function institutionUsers(): HasMany {
        return $this->hasMany(InstitutionUser::class);
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }

    public function accesses(): HasMany {
        return $this->hasMany(Access::class);
    }
}
