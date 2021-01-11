<?php

namespace App\Exceptions\Auth;

use App\Exceptions\Api\BaseApiException;
use Throwable;

/**
 *  @OA\Schema(schema="ApiInstitutionAlreadyExistsException",
 *      @OA\Property(property="code", type="integer", example=400),
 *      @OA\Property(property="message", type="string", example="INSTITUTION_ALREADY_EXISTS"),
 *      @OA\Property(property="description", type="string", example="Заведение с таким именем и адресом уже создано. Если вы являетесь владельцем заведения, но его нет у вас в списках заведений, обратитесь в службу поддержки."),
 *  )
 */
class InstitutionAlreadyExistsException extends BaseApiException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'INSTITUTION_ALREADY_EXISTS';
        $code = 422;
        parent::__construct($message, $code, $previous);
    }

    public function getDescription(): string
    {
        return __("api.errors.{$this->getMessage()}");
    }
}
