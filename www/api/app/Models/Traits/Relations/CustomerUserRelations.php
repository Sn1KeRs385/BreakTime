<?php

namespace App\Models\Traits\Relations;


use App\Models\Customer;
use App\Models\CustomerUserTimer;
use App\Models\Tariff;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait CustomerUserRelations
{
    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function tariff(): BelongsTo {
        return $this->hasMany(Tariff::class);
    }

    public function customerUserTimers(): HasMany {
        return $this->hasMany(CustomerUserTimer::class);
    }
}
