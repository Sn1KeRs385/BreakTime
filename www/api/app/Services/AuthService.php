<?php

namespace App\Services;


use App\Exceptions\Auth\WrongCredentialException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\PersonalAccessTokenResult;

class AuthService
{
    public function signup(string $firstName, string $lastName, string $patronymic, string $email, string $password): PersonalAccessTokenResult
    {
        $user = new User([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'patronymic' => $patronymic,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        $user->save();

        $token = $this->createToken($user);

        return $token;
    }

    public function login(string $email, string $password): PersonalAccessTokenResult
    {
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];
        if(!Auth::attempt($credentials)) {
            throw new WrongCredentialException();
        }
        $user = request()->user();

        $token = $this->createToken($user);

        return $token;
    }

    public function logout(User $user): void
    {
        $user->token()->revoke();
    }

    protected function createToken(User $user): PersonalAccessTokenResult
    {
        $tokenResult = $user->createToken('Personal Access Token');

        return $tokenResult;
    }
}
