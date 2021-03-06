<?php

namespace App\Models;

use App\Models\Traits\Relations\InstitutionRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Institution
 * @package App\Models
 *
 * @property int                             $id
 * @property string                          $name
 * @property int                             $location_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereDeletedAt($value)
 *
 * @method static Institution first()
 * @method static Institution firstWhere(array $array)
 * @method static Institution create(array $array)
 * @method static Institution updateOrCreate(array $arraySearch, array $arrayFill)
 */
class Institution extends Model
{
    use SoftDeletes;
    use HasFactory;
    use InstitutionRelations;

    public function getAddressAttribute(): string {
        $address = null;
        $location = $this->location;
        do {
            $address = "{$location->prefix}. {$location->name}" . ($address ? ", $address" : '');
            $location = $location->parent;
        } while($location);

        return $address;
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'location_id',
    ];
}
