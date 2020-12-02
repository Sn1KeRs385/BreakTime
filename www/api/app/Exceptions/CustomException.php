<?php

namespace App\Exceptions;

use Exception;

abstract class CustomException extends Exception
{
    abstract public function getDescription(): string;

    public function render(): array
    {
        return [
            'code' => $this->getCode(),
            'message' => $this->getMessage(),
            'description' => $this->getDescription(),
        ];
    }
}
