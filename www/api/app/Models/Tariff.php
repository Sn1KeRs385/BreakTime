<?php

namespace App\Models;

use App\Models\Traits\Relations\TariffRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tarif
 * @package App\Models
 *
 * @property int                             $id
 * @property int                             $institution_id
 * @property string                          $name
 * @property double                          $cost_visit
 * @property double                          $cost_minimum
 * @property double                          $cost_per_minute
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCostVisit($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCostMinimum($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCostPerMinute($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereDeletedAt($value)
 *
 * @method static Tariff first()
 * @method static Tariff firstWhere(array $array)
 * @method static Tariff create(array $array)
 * @method static Tariff updateOrCreate(array $arraySearch, array $arrayFill)
 */
class Tariff extends Model
{
    use SoftDeletes;
    use HasFactory;
    use TariffRelations;

    protected $fillable = [
        'institution_id',
        'name',
        'cost_visit',
        'cost_minimum',
        'cost_per_minute'
    ];
}
