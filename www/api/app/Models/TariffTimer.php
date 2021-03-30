<?php

namespace App\Models;

use App\Models\Traits\Relations\TariffTimerRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TariffTimer
 * @package App\Models
 *
 * @property int                             $id
 * @property int                             $tariff_id
 * @property int                             $minute_from
 * @property int                             $minute_to
 * @property double                          $cost
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereTariffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereMinuteFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereMinuteTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUpdatedAt($value)
 *
 * @method static TariffTimer first()
 * @method static TariffTimer firstWhere(array $array)
 * @method static TariffTimer create(array $array)
 * @method static TariffTimer updateOrCreate(array $arraySearch, array $arrayFill)
 */
class TariffTimer extends Model
{
    use HasFactory;
    use TariffTimerRelations;

    protected $fillable = [
        'tariff_id',
        'minute_from',
        'minute_to',
        'cost',
    ];
}
