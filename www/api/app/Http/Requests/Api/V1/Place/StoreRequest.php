<?php

namespace App\Http\Requests\Api\V1\Place;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *  @OA\Schema(schema="ApiV1PlaceStoreRequest",
 *      description="Посадочные места - создание",
 *      type="object",
 *      required={"institution_id", "name"},
 *      @OA\Property (property="institution_id", example=1, type="integer", description="Идентификатор заведения для выборки"),
 *      @OA\Property (property="name", type="string", maxLength=255, description="Название заведения", example="Стол 4"),
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
        ];
    }
}
