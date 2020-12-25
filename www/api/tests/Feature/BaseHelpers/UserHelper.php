<?php

namespace Tests\Feature\BaseHelpers;

use App\Models\User;

trait UserHelper
{
    protected function createUser($password = null): User {
        $user = User::factory()->make();
        if($password){
            $user->password = bcrypt($password);
        }
        $user->save();
        return $user;
    }
}
