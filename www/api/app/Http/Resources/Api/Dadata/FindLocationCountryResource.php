<?php

namespace App\Http\Resources\Api\Dadata;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(schema="ApiDadataFindLocationCountryResource",
 *      @OA\Property(property="value", type="string", description="Адрес одной строкой", example="Россия"),
 *      @OA\Property(property="unrestricted_value", type="string", description="Адрес одной строкой(полный, с инедксом)", example="Россия"),
 *      @OA\Property(property="data", type="object",
 *          @OA\Property(property="country", type="string", description="Страна", example="Россия"),
 *          @OA\Property(property="country_iso_code", type="string", description="ISO-код страны (двухсимвольный)", example="RU"),
 *      ),
 *  )
 */
class FindLocationCountryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'value' => $this->resource['value'],
            'unrestricted_value' => $this->resource['unrestricted_value'],
            'data' => [
                'country' => $this->resource['data']['country'],
                'country_iso_code' => $this->resource['data']['country_iso_code'],
            ],
        ];
    }
}
