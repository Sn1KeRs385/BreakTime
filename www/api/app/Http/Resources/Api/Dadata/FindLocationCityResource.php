<?php

namespace App\Http\Resources\Dadata\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(schema="ApiDadataFindLocationCityResource",
 *      @OA\Property(property="value", type="string", description="Адрес одной строкой", example="Саратовская обл, Энгельсский р-н, тер Безымянское МО"),
 *      @OA\Property(property="unrestricted_value", type="string", description="Адрес одной строкой(полный, с инедксом)", example="413143, Саратовская обл, Энгельсский р-н, тер Безымянское МО"),
 *      @OA\Property(property="data", type="object",
 *          @OA\Property(property="country", type="string", description="Страна", example="Россия"),
 *          @OA\Property(property="country_iso_code", type="string", description="ISO-код страны (двухсимвольный)", example="RU"),
 *          @OA\Property(property="kladr_id", type="string", description="Код КЛАДР", example="6403900200000"),
 *          @OA\Property(property="name", type="string", description="Название", example="Безымянское МО"),
 *          @OA\Property(property="type", type="string", description="Тип (сокращенный)", example="тер"),
 *          @OA\Property(property="type_full", type="string", description="Тип", example="территория"),
 *          @OA\Property(property="name_with_type", type="string", description="Название с типом", example="тер Безымянское МО"),
 *          @OA\Property(property="postal_code", type="string", description="Почтовый индекс", example="413143"),
 *      ),
 *  )
 */
class FindLocationCityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'value' => $this->resource['value'],
            'unrestricted_value' => $this->resource['unrestricted_value'],
            'data' => [
                'country' => $this->resource['data']['country'],
                'country_iso_code' => $this->resource['data']['country_iso_code'],

                'kladr_id' => $this->resource['data']['city_kladr_id'],
                'name' => $this->resource['data']['city'],
                'type' => $this->resource['data']['city_type'],
                'type_full' => $this->resource['data']['city_type_full'],
                'name_with_type' => $this->resource['data']['city_with_type'],

                'postal_code' => $this->resource['data']['postal_code'],
            ],
        ];
    }
}
