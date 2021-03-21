<?php

namespace App\Http\Requests\Api\V1\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *  @OA\Schema(schema="ApiV1ServiceStoreRequest",
 *      description="Товары/услуги - создание",
 *      type="object",
 *      required={"institution_id", "name"},
 *      @OA\Property (property="institution_id", example=1, type="integer", description="Идентификатор заведения"),
 *      @OA\Property (property="name", type="string", maxLength=255, description="Название товара/услуги", example="Пицца"),
 *      @OA\Property (property="price", type="double", minimum=0, description="Стоимость", example=200.50),
 *  )
 */
class StoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'institution_id' => [
                'required',
                'int',
                Rule::exists('institutions', 'id')
                    ->whereNull('deleted_at'),
            ],
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ];
    }
}
