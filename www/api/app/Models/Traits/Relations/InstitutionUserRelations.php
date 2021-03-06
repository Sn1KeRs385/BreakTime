<?php

namespace App\Models\Traits\Relations;


use App\Models\Institution;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait InstitutionUserRelations
{
    public function institution(): BelongsTo {
        return $this->belongsTo(Institution::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
