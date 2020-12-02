<?php

namespace App\Exceptions\Auth;

use Throwable;

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
