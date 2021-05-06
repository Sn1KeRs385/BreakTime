<?php

namespace App\Http\Requests\Api\V1\Service;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *  @OA\Schema(schema="ApiV1ServiceDeleteRequest",
 *      description="Товары/услуги - удаление",
 *      type="object",
 *      required={"id"},
 *      @OA\Property (property="id", example=1, type="integer", description="Идентификатор товара/услуги"),
 *  )
 */
class DeleteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => [
                'required',
                'int',
                Rule::exists('services', 'id')
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
