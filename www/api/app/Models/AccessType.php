<?php

namespace App\Models;

use App\Models\Traits\Relations\AccessTypeRelations;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AccessType
 * @package App\Models
 *
 * @property int    $id
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereName($value)
 *
 * @method static AccessType first()
 * @method static AccessType firstWhere(array $array)
 * @method static AccessType create(array $array)
 * @method static AccessType updateOrCreate(array $arraySearch, array $arrayFill)
 */
class AccessType extends Model
{
    use AccessTypeRelations;
}
