<?php

namespace App\Models;

use App\Traits\Models\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class InstitutionUser
 * @package App\Models
 *
 * @property int     $institution_id
 * @property int     $user_id
 * @property boolean $is_invite_accept
 * @property boolean $is_admin
 * @property boolean $is_can_change_info
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereIsInviteAccept($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereIsCanChangeInfo($value)
 *
 * @method static InstitutionUser first()
 * @method static InstitutionUser firstWhere(array $array)
 */
class InstitutionUser extends Model
{
    use HasCompositePrimaryKey;

    protected $primaryKey = ['institution_id', 'user_id'];

    public function institution(): BelongsTo {
        return $this->belongsTo(Institution::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'is_invite_accept'   => 'boolean',
        'is_admin'           => 'boolean',
        'is_can_change_info' => 'boolean',
    ];

    protected $fillable = [
        'institution_id',
        'user_id',
        'is_admin',
        'can_change_info',
    ];
}
