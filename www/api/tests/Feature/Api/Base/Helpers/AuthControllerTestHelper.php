<?php

namespace Tests\Feature\Api\Base\Helpers;

use App\Models\User;
use App\Services\AuthService;
use Laravel\Passport\PersonalAccessTokenResult;
use Tests\Feature\BaseHelpers\BaseHelper;
use Tests\Feature\BaseHelpers\UserHelper;

trait AuthControllerTestHelper
{
    use BaseHelper, UserHelper;

    protected static array $TOKEN_STRUCTURE = [
        'access_token',
        'token_type',
        'expires_at'
    ];

    protected function getDataSignUp(): array {
        $password = $this->faker->text(50);
        return [
            'last_name' => $this->faker->name(),
            'first_name' => $this->faker->firstName(),
            'email' => $this->faker->email,
            'password' => $password,
            'password_confirmation' => $password,
        ];
    }

    protected function getDataLogin(): array {
        $password = $this->faker->text(50);

        $user = $this->createUser($password);

        return [
            'email' => $user->email,
            'password' => $password,
        ];
    }

    protected function getDataLogout(): array {
        $user = $this->createUser();

        $token = $user->createToken('Personal Access Token');

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
