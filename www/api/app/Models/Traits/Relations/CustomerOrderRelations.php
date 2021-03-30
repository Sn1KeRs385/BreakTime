<?php

namespace App\Models\Traits\Relations;


use App\Models\Customer;
use App\Models\Service;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CustomerOrderRelations
{
    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function service(): BelongsTo {
        return $this->belongsTo(Service::class);
    }
}
