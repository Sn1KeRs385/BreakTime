<?php

namespace App\Http\Requests\Api\V1\Tariff;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *  @OA\Schema(schema="ApiV1TariffDeleteRequest",
 *      description="Тариф - удаление",
 *      type="object",
 *      required={"id"},
 *      @OA\Property (property="id", example=1, type="integer", description="Идентификатор тарифа"),
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
                Rule::exists('tariffs', 'id')
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
