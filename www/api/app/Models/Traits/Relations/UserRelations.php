<?php

namespace App\Models\Traits\Relations;

use App\Models\Institution;
use App\Models\InstitutionUser;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserRelations
{
    public function institutions(): BelongsToMany {
        return $this->belongsToMany(Institution::class);
    }
    public function institutionUsers(): HasMany {
        return $this->hasMany(InstitutionUser::class);
    }
}
