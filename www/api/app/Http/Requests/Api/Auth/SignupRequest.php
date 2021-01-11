<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 *  @OA\Schema(schema="ApiAuthSignupRequest",
 *      description="Авторизация - регистрация пользователя",
 *      type="object",
 *      required={"last_name", "first_name", "email", "password", "password_confirmation"},
 *      @OA\Property (property="last_name", type="string", maxLength=255, description="Фамилия", example="Иванов"),
 *      @OA\Property (property="first_name", type="string", maxLength=255, description="Имя", example="Иван"),
 *      @OA\Property (property="patronymic", type="string", maxLength=255, nullable=true, description="Отчество", example="Иванович"),
 *      @OA\Property (property="email", type="email", maxLength=255, description="Почта", example="Ivanov@mail.ru"),
 *      @OA\Property (property="password", type="string", description="Пароль", example="Passwod123"),
 *      @OA\Property (property="password_confirmation", type="string", description="Подтверждение пароля", example="Passwod123"),
 *  )
 */
class SignupRequest extends FormRequest
{
    public function rules()
    {
        return [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'patronymic' => 'sometimes|nullable|string|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'password' => 'required|string|confirmed'
        ];
    }
}
