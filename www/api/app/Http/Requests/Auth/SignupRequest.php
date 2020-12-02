<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

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
