<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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
 */
class Institution extends Model
{
    use SoftDeletes;

    public function location(): BelongsTo {
        return $this->belongsTo(Location::class);
    }

    public function institutionUsers(): HasMany {
        return $this->hasMany(InstitutionUser::class);
    }

    public function users(): HasManyThrough {
        return $this->hasManyThrough(User::class, InstitutionUser::class);
    }

    public function accesses(): HasMany {
        return $this->hasMany(Access::class);
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
