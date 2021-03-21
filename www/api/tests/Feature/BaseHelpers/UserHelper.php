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

    protected function getFullAccessWithExcludes(array $excludes = []): array {
        $accessList = [
            'is_invite_accept' => true,
            'is_can_change_info' => true,
            'is_can_create_place' => true,
            'is_can_update_place' => true,
            'is_can_delete_place' => true,
        ];

        foreach($excludes as $exclude){
            $accessList[$exclude] = false;
        }

        return $accessList;
    }

    protected function getAccessByArray(array $accesses = []): array {
        $accessList = [
            'is_invite_accept' => true,
        ];

        foreach($accesses as $access){
            $accessList[$access] = true;
        }

        return $accessList;
    }
}
