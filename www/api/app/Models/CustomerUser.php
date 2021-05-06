<?php

namespace App\Models;

use App\Models\Traits\Relations\CustomerUserRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CustomerUser
 * @package App\Models
 *
 * @property int                             $id
 * @property int                             $customer_id
 * @property int                             $user_id
 * @property int                             $tariff_id
 * @property string                          $description
 * @property double                          $price_total
 * @property double                          $price_paid
 * @property \Illuminate\Support\Carbon|null $account_received_at
 * @property \Illuminate\Support\Carbon|null $account_paid_at
 * @property \Illuminate\Support\Carbon|null $end_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereTariffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder wherePriceTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder wherePricePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereAccountReceivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereAccountPaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereDeletedAt($value)
 *
 * @method static CustomerUser first()
 * @method static CustomerUser firstWhere(array $array)
 * @method static CustomerUser create(array $array)
 * @method static CustomerUser updateOrCreate(array $arraySearch, array $arrayFill)
 */
class CustomerUser extends Model
{
    use SoftDeletes;
//    use HasFactory;
    use CustomerUserRelations;

    protected $dates = [
        'account_received_at',
        'account_paid_at',
        'end_at',
    ];

    protected $fillable = [
        'customer_id',
        'user_id',
        'tariff_id',
        'description',
        'price_total',
        'price_paid',
        'account_received_at',
        'account_paid_at',
        'end_at',
    ];
}
