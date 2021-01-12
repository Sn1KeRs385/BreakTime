<?php

namespace App\Http\Requests\Api\Dadata;

use App\Constants\Dadata\DadataBounds;
use Illuminate\Foundation\Http\FormRequest;

/**
 *  @OA\Schema(schema="ApiDadataFindLocationRequest",
 *      description="Dadata - поиск места",
 *      type="object",
 *      required={"query", "bound"},
 *      @OA\Property (property="query", type="string", maxLength=255, description="Поисковый запрос", example="Тюме"),
 *      @OA\Property (property="bound", type="string", description="Ограничение поиска по субъектам. Может принимать значения: country - страна; region - регион; area - район; city - город; settlement - населенный пункт; street - улица; house - дом", example="city"),
 *      @OA\Property (property="count", type="integer", minimum=1, maximum=100, default=10, description="Количество элементов в списке", example="25"),
 *      @OA\Property (property="find_in", type="object", description="Фильтр поиска",
 *          @OA\Property (property="kladr_id", type="string", nullable=true, description="Ограничения поиска по kladr_id", example="7700000000000"),
 *          @OA\Property (property="country_iso_code", type="string", nullable=true, maxLength=255, description="Ограничение по стране. Если имеется kladr_id, то приоритет поиска будет по нему. Если bound = country, то это поле не будет учитываться", example="RU"),
 *      ),
 *  )
 */
class FindLocationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'query' => 'required|string|max:255',
            'bound' => 'required|string|in:' . implode(',', DadataBounds::AVAILABLE),
            'count' => 'sometimes|int|min:1|max:100',
            'find_in' => 'sometimes|nullable|array',
            'find_in.kladr_id' => 'sometimes|nullable|string|max:255',
            'find_in.country_iso_code' => 'sometimes|nullable|string|max:255',
        ];
    }
}
