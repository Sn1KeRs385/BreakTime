<?php

namespace App\Models;

use App\Models\Traits\Relations\UserRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App\Models
 *
 * @property int                             $id
 * @property string                          $last_name
 * @property string                          $first_name
 * @property string|null                     $patronymic
 * @property string                          $name
 * @property string                          $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder query()
 * @method static \Illuminate\Database\Eloquent\Builder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder whereUpdatedAt($value)
 *
 * @method static User first()
 * @method static User firstWhere(array $array)
 * @method static User create(array $array)
 * @method static User updateOrCreate(array $arraySearch, array $arrayFill)
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    use UserRelations;

    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
