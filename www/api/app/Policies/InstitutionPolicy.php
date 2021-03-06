<?php

namespace App\Policies;

use App\Models\Institution;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstitutionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Institution $institution)
    {
        return $institution->institutionUsers()
            ->where('user_id', $user->id)
            ->where('is_invite_accept', true)
            ->exists();
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Institution $institution)
    {
        //
    }

    public function delete(User $user, Institution $institution)
    {
        //
    }

    public function restore(User $user, Institution $institution)
    {
        //
    }

    public function forceDelete(User $user, Institution $institution)
    {
        //
    }
}
