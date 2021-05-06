<?php

namespace App\Models;

use App\Models\Traits\Relations\CustomerUserRelations;
use App\Models\Traits\Relations\CustomerUserTimerRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CustomerUserTimer
 * @package App\Models
 *
 * @property int                             $id
 * @property int                             $customer_user_id
 * @property \Illuminate\Support\Carbon $start_at
 * @property \Illuminate\Support\Carbon|null $end_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCustomerUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereDeletedAt($value)
 *
 * @method static CustomerUserTimer first()
 * @method static CustomerUserTimer firstWhere(array $array)
 * @method static CustomerUserTimer create(array $array)
 * @method static CustomerUserTimer updateOrCreate(array $arraySearch, array $arrayFill)
 */
class CustomerUserTimer extends Model
{
    use SoftDeletes;
//    use HasFactory;
    use CustomerUserTimerRelations;

    protected $dates = [
        'start_at',
        'end_at',
    ];

    protected $fillable = [
        'customer_user_id',
        'start_at',
        'end_at',
    ];
}
