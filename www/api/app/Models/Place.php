<?php

namespace App\Models;

use App\Models\Traits\Relations\PlaceRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Institution
 * @package App\Models
 *
 * @property int                             $id
 * @property int                             $institution_id
 * @property string                          $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereDeletedAt($value)
 *
 * @method static Place first()
 * @method static Place firstWhere(array $array)
 * @method static Place create(array $array)
 * @method static Place updateOrCreate(array $arraySearch, array $arrayFill)
 */
class Place extends Model
{
    use SoftDeletes;
    use HasFactory;
    use PlaceRelations;

    protected $fillable = [
        'institution_id',
        'name',
    ];
}
