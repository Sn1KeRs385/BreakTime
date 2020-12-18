<?php

namespace App\Exceptions;

use Exception;

/**
 *  @OA\Schema(schema="CustomException",
 *      @OA\Property(property="code", type="integer", example=422),
 *      @OA\Property(property="message", type="string", example="Какая-нибудь ошибка"),
 *      @OA\Property(property="description", type="string", example="Описание ошибки"),
 *  )
 */
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
