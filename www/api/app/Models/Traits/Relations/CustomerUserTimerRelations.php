<?php

namespace App\Models\Traits\Relations;


use App\Models\CustomerUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CustomerUserTimerRelations
{
    public function customerUser(): BelongsTo {
        return $this->belongsTo(CustomerUser::class);
    }
}
