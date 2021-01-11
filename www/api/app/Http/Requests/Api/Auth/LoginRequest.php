<?php

namespace App\Http\Requests\Auth\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 *  @OA\Schema(schema="ApiAuthLoginRequest",
 *      description="Авторизация - вход пользователя",
 *      type="object",
 *      required={"email", "password"},
 *      @OA\Property (property="email", type="email", maxLength=255, description="Почта", example="Ivanov@mail.ru"),
 *      @OA\Property (property="password", type="string", description="Пароль", example="Passwod123"),
 *  )
 */
class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|string|max:255|email',
            'password' => 'required|string',
        ];
    }
}
