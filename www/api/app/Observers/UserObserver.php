<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->name = "{$user->last_name} {$user->first_name}" . ($user->patronymic ? " $user->patronymic" : '');
    }

    public function updating(User $user)
    {
        $user->name = "{$user->last_name} {$user->first_name}" . ($user->patronymic ? " $user->patronymic" : '');
    }
}
