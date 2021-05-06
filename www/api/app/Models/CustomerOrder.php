<?php

namespace App\Models;

use App\Models\Traits\Relations\CustomerOrderRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CustomerOrder
 * @package App\Models
 *
 * @property int                             $id
 * @property int                             $customer_id
 * @property int                             $service_id
 * @property int                             $count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereDeletedAt($value)
 *
 * @method static CustomerOrder first()
 * @method static CustomerOrder firstWhere(array $array)
 * @method static CustomerOrder create(array $array)
 * @method static CustomerOrder updateOrCreate(array $arraySearch, array $arrayFill)
 */
class CustomerOrder extends Model
{
    use SoftDeletes;
//    use HasFactory;
    use CustomerOrderRelations;

    protected $fillable = [
        'customer_id',
        'service_id',
        'count',
    ];
}
