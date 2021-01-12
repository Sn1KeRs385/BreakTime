<?php

namespace App\Http\Requests\Api\V1\Institution;

use Illuminate\Foundation\Http\FormRequest;

/**
 *  @OA\Schema(schema="ApiV1InstitutionStoreRequest",
 *      description="Заведения - создание",
 *      type="object",
 *      required={"name", "kladr_id", "fias_id"},
 *      @OA\Property (property="name", type="string", maxLength=255, description="Название заведения", example="Кафе у дороги"),
 *      @OA\Property (property="kladr_id", type="string", maxLength=255, description="КЛАДР код дома, в котором находится заведение", example="7200000100001080062"),
 *      @OA\Property (property="fias_id", type="string", maxLength=255, description="ФИАС код дома, в котором находится заведение", example="909a442e-8b06-4fab-af27-26c2601fa407"),
 *  )
 */
class StoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'fias_id' => [
                'required',
                'string',
                'max:255',
            ],
            'kladr_id' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
