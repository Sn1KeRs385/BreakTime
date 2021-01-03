<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Access
 * @package App\Models
 *
 * @property int                             $id
 * @property int                             $type_id
 * @property int                             $institution_id
 * @property \Illuminate\Support\Carbon|null $start_at
 * @property \Illuminate\Support\Carbon|null $end_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUpdatedAt($value)
 *
 * @method static Access first()
 * @method static Access firstWhere(array $array)
 */
class Access extends Model
{
    public function type(): BelongsTo {
        return $this->belongsTo(AccessType::class);
    }

    public function institution(): BelongsTo {
        return $this->belongsTo(Institution::class);
    }

    protected $casts = [
        'start_at'   => 'datetime',
        'end_at'     => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'type_id',
        'institution_id',
        'start_at',
        'end_at',
    ];
}
