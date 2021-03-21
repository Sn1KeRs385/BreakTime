<?php

namespace App\Http\Requests\Api\V1\Place;

use App\Models\Place;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *  @OA\Schema(schema="ApiV1PlaceDeleteRequest",
 *      description="Посадочные места - удаление",
 *      type="object",
 *      required={"id"},
 *      @OA\Property (property="id", example=1, type="integer", description="Идентификатор посадочного места"),
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
                Rule::exists('places', 'id')
                    ->whereNull('deleted_at'),
            ],
        ];
    }
}
