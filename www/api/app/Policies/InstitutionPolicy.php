<?php

namespace App\Policies;

use App\Models\Institution;
use App\Models\User;

class InstitutionPolicy extends BasePolicy
{
    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Institution $institution)
    {
        return $this->checkAccess($user, $institution, 'is_invite_accept');
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
