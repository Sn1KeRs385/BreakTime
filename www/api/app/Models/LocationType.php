<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class User
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
 */
class LocationType extends Model
{
    public function locations(): HasMany {
        return $this->hasMany(Location::class);
    }
}
