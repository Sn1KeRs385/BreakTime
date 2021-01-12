<?php

namespace App\Http\Requests\Api\V1\Institution;

use App\Constants\Dadata\DadataBounds;
use Illuminate\Foundation\Http\FormRequest;

/**
 *  @OA\Schema(schema="ApiV1InstitutionIndexRequest",
 *      description="Заведения - список",
 *      type="object",
 *      @OA\Property (property="per_page", type="integer", minimum=1, default=10, description="Количество заведений за один запрос", example=10),
 *      @OA\Property (property="page", type="integer", minimum=1, default=10, description="Страница", example=1),
 *      @OA\Property (property="only_my", type="boolean", default=false, description="Показать только заведения, где пользователь работает", example=false),
 *      @OA\Property (property="filters", type="array", description="Фильтры поиска",
 *          @OA\Items(type="object",
 *              @OA\Property (property="type", type="string", description="Ограничение поиска по субъектам. Может принимать значения: country - страна; region - регион; area - район; city - город; settlement - населенный пункт; street - улица; house - дом", example="city"),
 *              @OA\Property (property="value", type="string", minimum=1, description="Строка поиска (название или код КЛАДР)", example="7700000000000"),
 *          )
 *      )
 *  )
 */
class IndexRequest extends FormRequest
{
    public function rules()
    {
        return [
            'per_page' => 'sometimes|int|min:1',
            'page' => 'sometimes|int|min:1',
            'only_my' => 'sometimes|boolean',
            'filters' => 'sometimes|array',
            'filters.*' => 'sometimes|array',
            'filters.*.type' => 'required|string|in:' . implode(',', DadataBounds::AVAILABLE),
            'filters.*.value' => 'required|string|min:1',
        ];
    }
}
