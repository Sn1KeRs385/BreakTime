<?php

namespace App\Http\Requests\Api\V1\Service;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *  @OA\Schema(schema="ApiV1ServiceUpdateRequest",
 *      description="Товары/услуги - редактирование",
 *      type="object",
 *      required={"id", "name"},
 *      @OA\Property (property="id", example=1, type="integer", description="Идентификатор товара/услуги"),
 *      @OA\Property (property="name", type="string", maxLength=255, description="Новое название товара/услуги", example="Запеканка"),
 *      @OA\Property (property="price", type="double", minimum=0, description="Стоимость", example=200.50),
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
                Rule::exists('services', 'id')
                    ->whereNull('deleted_at'),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('services', 'name')
                    ->where('institution_id', (Service::find($this->id)->institution_id ?? null))
                    ->ignore($this->id),
            ],
            'price' => 'required|numeric|min:0.01',
        ];
    }
}
