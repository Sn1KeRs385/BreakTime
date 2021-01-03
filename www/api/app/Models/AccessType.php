<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 */
class AccessType extends Model
{
    public function accesses(): HasMany {
        return $this->hasMany(Access::class);
    }
}
