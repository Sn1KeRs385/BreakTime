<?php

namespace App\Http\Controllers;


use App\Helpers\JSON;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Http\Resources\Auth\TokenResource;
use Illuminate\Http\Request;
use App\Services\AuthService;

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
     *      operationId="AuthControllerSignup",
     *      summary="Регистрация нового аккаунта",
     *      tags={"Auth"},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/AuthSignupRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/AuthTokenResource")),
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
     *      operationId="AuthControllerLogin",
     *      summary="Авторизация пользователя",
     *      tags={"Auth"},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/AuthLoginRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/AuthTokenResource")),
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
     *      operationId="AuthControllerLogout",
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
