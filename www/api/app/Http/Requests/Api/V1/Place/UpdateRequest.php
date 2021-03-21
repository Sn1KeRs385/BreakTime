<?php

namespace App\Http\Requests\Api\V1\Place;

use App\Models\Place;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *  @OA\Schema(schema="ApiV1PlaceUpdateRequest",
 *      description="Посадочные места - редактирование",
 *      type="object",
 *      required={"id", "name"},
 *      @OA\Property (property="id", example=1, type="integer", description="Идентификатор посадочного места"),
 *      @OA\Property (property="name", type="string", maxLength=255, description="Новое название заведения", example="Стол 41"),
 *  )
 */
class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => [
                'required',
                'int',
                Rule::exists('places', 'id')
                    ->whereNull('deleted_at'),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('places', 'name')
                    ->where('institution_id', (Place::find($this->id)->institution_id ?? null))
                    ->ignore($this->id),
            ],
        ];
    }
}
