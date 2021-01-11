<?php

namespace App\Exceptions\Api\Dadata;

use Throwable;

/**
 *  @OA\Schema(schema="ApiDadataLocationNotFoundInDadataException",
 *      @OA\Property(property="code", type="integer", example=404),
 *      @OA\Property(property="message", type="string", example="LOCATION_NOT_FOUND_IN_DADATA"),
 *      @OA\Property(property="description", type="string", example="Не удалось найти адрес в системе 'Dadata'."),
 *  )
 */
class LocationNotFoundInDadataException extends BaseDadataException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'LOCATION_NOT_FOUND_IN_DADATA';
        $code = 404;
        parent::__construct($message, $code, $previous);
    }

    public function getDescription(): string
    {
        return __("dadata.errors.{$this->getMessage()}");
    }
}
