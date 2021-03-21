<?php

namespace App\Http\Requests\Api\V1\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *  @OA\Schema(schema="ApiV1ServiceAllRequest",
 *      description="Товары/услуги - весь список",
 *      type="object",
 *      required={"institution_id"},
 *      @OA\Property (property="institution_id", example=1, type="integer", description="Идентификатор заведения для выборки"),
 *  )
 */
class AllRequest extends FormRequest
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
        ];
    }
}
