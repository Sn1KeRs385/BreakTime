<?php

namespace App\Models;

use App\Models\Traits\Relations\LocationTypeRelations;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LocationType
 * @package App\Models
 *
 * @property int    $id
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereName($value)
 *
 * @method static LocationType first()
 * @method static LocationType firstWhere(array $array)
 * @method static LocationType create(array $array)
 * @method static LocationType updateOrCreate(array $arraySearch, array $arrayFill)
 */
class LocationType extends Model
{
    use LocationTypeRelations;
}
