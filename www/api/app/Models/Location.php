<?php

namespace App\Models;

use App\Models\Traits\Relations\LocationRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * @package App\Models
 *
 * @property int                             $id
 * @property int                             $type_id
 * @property string                          $prefix
 * @property string                          $name
 * @property string                          $kladr_id
 * @property string|null                     $fias_id
 * @property int                             $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereKladrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereFiasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUpdatedAt($value)
 *
 * @method static Location first()
 * @method static Location firstWhere(array $array)
 * @method static Location create(array $array)
 * @method static Location updateOrCreate(array $arraySearch, array $arrayFill)
 */
class Location extends Model
{
    use HasFactory;
    use LocationRelations;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'type_id',
        'prefix',
        'name',
        'kladr_id',
        'fias_id',
        'parent_id',
    ];
}
