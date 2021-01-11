<?php

namespace App\Http\Controllers\Api;


use App\Helpers\JSON;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\SignupRequest;
use App\Http\Resources\Api\Auth\TokenResource;
use Illuminate\Http\Request;
use App\Services\Api\AuthService;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     *  @OA\Post(
     *      path="/auth/signup",
     *      operationId="ApiAuthControllerSignup",
     *      summary="Регистрация нового аккаунта",
     *      tags={"Auth"},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiAuthSignupRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiAuthTokenResource")),
     *  )
     */
    public function signup(SignupRequest $request)
    {
        $token = $this->authService->signup(
            $request->first_name,
            $request->last_name,
            $request->input('patronymic'),
            $request->email,
            $request->password
        );

        return JSON::getJson(TokenResource::make($token));
    }

    /**
     *  @OA\Post(
     *      path="/auth/login",
     *      operationId="ApiAuthControllerLogin",
     *      summary="Авторизация пользователя",
     *      tags={"Auth"},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiAuthLoginRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiAuthTokenResource")),
     *      @OA\Response(response=401, description="Ошибка 'WRONG_CREDENTIAL'", @OA\JsonContent(ref="#/components/schemas/AuthWrongCredentialException")),
     *  )
     */
    public function login(LoginRequest $request)
    {
        $token = $this->authService->login(
            $request->email,
            $request->password,
        );

        return JSON::getJson(TokenResource::make($token));
    }

    /**
     *  @OA\Post(
     *      path="/auth/logout",
     *      operationId="ApiAuthControllerLogout",
     *      summary="Выход пользователя из системы",
     *      tags={"Auth"},
     *      security={{"api_auth":{}}},
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(example=null)),
     *  )
     */
    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return JSON::getJson();
    }
}
