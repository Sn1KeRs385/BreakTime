<?php

namespace App\Policies;

use App\Models\Place;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlacePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Place $place)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Place $place)
    {
        //
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
