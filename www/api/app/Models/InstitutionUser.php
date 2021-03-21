<?php

namespace App\Models;

use App\Models\Traits\Relations\InstitutionUserRelations;
use App\Traits\Models\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Relations\Pivot;

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
 * @method static InstitutionUser create(array $array)
 * @method static InstitutionUser updateOrCreate(array $arraySearch, array $arrayFill)
 */
class InstitutionUser extends Pivot
{
    use InstitutionUserRelations;

    public $timestamps = false;
    protected $fillable = [
        'institution_id',
        'user_id',
        'is_invite_accept',
        'is_admin',
        'is_can_change_info',
        'is_can_create_place',
        'is_can_update_place',
        'is_can_delete_place',
    ];
}
