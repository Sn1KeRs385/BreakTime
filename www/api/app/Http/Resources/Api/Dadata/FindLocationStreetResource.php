<?php

namespace App\Http\Resources\Api\Dadata;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(schema="ApiDadataFindLocationStreetResource",
 *      @OA\Property(property="value", type="string", description="Адрес одной строкой", example="Саратовская обл, Энгельсский р-н, село Березовка, ул Им А.Ф.Михеева"),
 *      @OA\Property(property="unrestricted_value", type="string", description="Адрес одной строкой(полный, с инедксом)", example="413154, Саратовская обл, Энгельсский р-н, село Березовка, ул Им А.Ф.Михеева"),
 *      @OA\Property(property="data", type="object",
 *          @OA\Property(property="country", type="string", description="Страна", example="Россия"),
 *          @OA\Property(property="country_iso_code", type="string", description="ISO-код страны (двухсимвольный)", example="RU"),
 *          @OA\Property(property="kladr_id", type="string", description="Код КЛАДР", example="64039000004000800"),
 *          @OA\Property(property="name", type="string", description="Название", example="Им А.Ф.Михеева"),
 *          @OA\Property(property="type", type="string", description="Тип (сокращенный)", example="ул"),
 *          @OA\Property(property="type_full", type="string", description="Тип", example="улица"),
 *          @OA\Property(property="name_with_type", type="string", description="Название с типом", example="ул Им А.Ф.Михеева"),
 *          @OA\Property(property="postal_code", type="string", description="Почтовый индекс", example="413154"),
 *      ),
 *  )
 */
class FindLocationStreetResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'value' => $this->resource['value'],
            'unrestricted_value' => $this->resource['unrestricted_value'],
            'data' => [
                'country' => $this->resource['data']['country'],
                'country_iso_code' => $this->resource['data']['country_iso_code'],

                'kladr_id' => $this->resource['data']['street_kladr_id'],
                'name' => $this->resource['data']['street'],
                'type' => $this->resource['data']['street_type'],
                'type_full' => $this->resource['data']['street_type_full'],
                'name_with_type' => $this->resource['data']['street_with_type'],

                'postal_code' => $this->resource['data']['postal_code'],
            ],
        ];
    }
}
