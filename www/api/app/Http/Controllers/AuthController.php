<?php

namespace App\Http\Controllers;


use App\Exceptions\Auth\WrongCredentialException;
use App\Helpers\JSON;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Http\Resources\Auth\TokenResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function signup(SignupRequest $request)
    {
        $token = $this->authService->signup(
            $request->first_name,
            $request->last_name,
            $request->patronymic,
            $request->email,
            $request->password
        );

        return JSON::getJson(TokenResource::make($token));
    }

    public function login(LoginRequest $request)
    {
        $token = $this->authService->login(
            $request->email,
            $request->password,
        );

        return JSON::getJson(TokenResource::make($token));
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return JSON::getJson();
    }
}
