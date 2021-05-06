<?php

namespace App\Policies;

use App\Models\Institution;
use App\Models\Service;
use App\Models\Tariff;
use App\Models\User;

class TariffPolicy extends BasePolicy
{
    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Tariff $tariff)
    {
        //
    }

    public function create(User $user, Institution $institution)
    {
        return $this->checkAccess($user, $institution, 'is_can_create_tariff');
    }

    public function update(User $user, Tariff $tariff)
    {
        return $this->checkAccess($user, $tariff->institution, 'is_can_update_tariff');
    }

    public function delete(User $user, Tariff $tariff)
    {
        return $this->checkAccess($user, $tariff->institution, 'is_can_delete_tariff');
    }

    public function restore(User $user, Tariff $tariff)
    {
        //
    }

    public function forceDelete(User $user, Tariff $tariff)
    {
        //
    }
}
