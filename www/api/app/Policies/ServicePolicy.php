<?php

namespace App\Policies;

use App\Models\Institution;
use App\Models\Service;
use App\Models\User;

class ServicePolicy extends BasePolicy
{
    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Service $service)
    {
        //
    }

    public function create(User $user, Institution $institution)
    {
        return $this->checkAccess($user, $institution, 'is_can_create_service');
    }

    public function update(User $user, Service $service)
    {
        return $this->checkAccess($user, $service->institution, 'is_can_update_service');
    }

    public function delete(User $user, Service $service)
    {
        //
    }

    public function restore(User $user, Service $service)
    {
        //
    }

    public function forceDelete(User $user, Service $service)
    {
        //
    }
}
