<?php

namespace App\Exceptions\Api\Auth;

use Throwable;

/**
 *  @OA\Schema(schema="ApiAuthWrongCredentialException",
 *      @OA\Property(property="code", type="integer", example=401),
 *      @OA\Property(property="message", type="string", example="WRONG_CREDENTIAL"),
 *      @OA\Property(property="description", type="string", example="Неверное имя пользователя или пароль."),
 *  )
 */
class WrongCredentialException extends BaseAuthException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'WRONG_CREDENTIAL';
        $code = 401;
        parent::__construct($message, $code, $previous);
    }

    public function getDescription(): string
    {
        return __("auth.errors.{$this->getMessage()}");
    }
}
