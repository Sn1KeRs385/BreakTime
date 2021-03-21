<?php

namespace App\Policies;

use App\Models\Institution;
use App\Models\Place;
use App\Models\User;

class PlacePolicy extends BasePolicy
{
    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Place $place)
    {
        //
    }

    public function create(User $user, Institution $institution)
    {
        return $this->checkAccess($user, $institution, 'is_can_create_place');
    }

    public function update(User $user, Place $place)
    {
        return $this->checkAccess($user, $place->institution, 'is_can_update_place');
    }

    public function delete(User $user, Place $place)
    {
        //
    }

    public function restore(User $user, Place $place)
    {
        //
    }

    public function forceDelete(User $user, Place $place)
    {
        //
    }
}
