<?php

namespace App\Exceptions\Auth;

use App\Exceptions\Api\BaseApiException;
use Throwable;

/**
 *  @OA\Schema(schema="ApiLocationNotHouseTypeException",
 *      @OA\Property(property="code", type="integer", example=422),
 *      @OA\Property(property="message", type="string", example="LOCATION_NOT_HOUSE_TYPE"),
 *      @OA\Property(property="description", type="string", example="Адрес не является домом."),
 *  )
 */
class LocationNotHouseTypeException extends BaseApiException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'LOCATION_NOT_HOUSE_TYPE';
        $code = 422;
        parent::__construct($message, $code, $previous);
    }

    public function getDescription(): string
    {
        return __("api.errors.{$this->getMessage()}");
    }
}
