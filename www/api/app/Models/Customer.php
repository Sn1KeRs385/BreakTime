<?php

namespace App\Models;

use App\Models\Traits\Relations\CustomerRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 * @package App\Models
 *
 * @property int                             $id
 * @property int                             $institution_id
 * @property int                             $place_id
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
 * @method static \Illuminate\Database\Eloquent\Builder whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder wherePlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder wherePriceTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder wherePricePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereAccountReceivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereAccountPaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereAccountEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereDeletedAt($value)
 *
 * @method static Customer first()
 * @method static Customer firstWhere(array $array)
 * @method static Customer create(array $array)
 * @method static Customer updateOrCreate(array $arraySearch, array $arrayFill)
 */
class Customer extends Model
{
    use SoftDeletes;
//    use HasFactory;
    use CustomerRelations;

    protected $dates = [
        'account_received_at',
        'account_paid_at',
        'end_at',
    ];

    protected $fillable = [
        'institution_id',
        'place_id',
        'description',
        'price_total',
        'price_paid',
        'account_received_at',
        'account_paid_at',
        'end_at',
    ];
}
