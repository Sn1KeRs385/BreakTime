<?php

namespace App\Policies;

use App\Models\Institution;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasePolicy
{
    use HandlesAuthorization;

    protected function checkAccess(User $user, Institution $institution, ?string $accessField = null): bool
    {
        return $institution->institutionUsers()
            ->where('user_id', $user->id)
            ->where('is_invite_accept', true)
            ->where(function($query) use ($accessField) {
                $query
                    ->where('is_admin', true)
                    ->when($accessField, function($query) use($accessField) {
                       $query->orWhere($accessField, true);
                    });
            })
            ->exists();
    }
}
