<?php

namespace App\Http\Resources\Api\Dadata;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(schema="ApiDadataFindLocationAreaResource",
 *      @OA\Property(property="value", type="string", description="Адрес одной строкой", example="Саратовская обл, Энгельсский р-н"),
 *      @OA\Property(property="unrestricted_value", type="string", description="Адрес одной строкой(полный, с инедксом)", example="Саратовская обл, Энгельсский р-н"),
 *      @OA\Property(property="data", type="object",
 *          @OA\Property(property="country", type="string", description="Страна", example="Россия"),
 *          @OA\Property(property="country_iso_code", type="string", description="ISO-код страны (двухсимвольный)", example="RU"),
 *          @OA\Property(property="kladr_id", type="string", description="Код КЛАДР", example="6403900000000"),
 *          @OA\Property(property="fias_id", type="string", description="Код ФИАС", example="7051ab15-7d76-4817-9bec-b61e18ef91d2"),
 *          @OA\Property(property="name", type="string", description="Название", example="Энгельсский"),
 *          @OA\Property(property="type", type="string", description="Тип (сокращенный)", example="р-н"),
 *          @OA\Property(property="type_full", type="string", description="Тип", example="район"),
 *          @OA\Property(property="name_with_type", type="string", description="Название с типом", example="Энгельсский р-н"),
 *      ),
 *  )
 */
class FindLocationAreaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'value' => $this->resource['value'],
            'unrestricted_value' => $this->resource['unrestricted_value'],
            'data' => [
                'country' => $this->resource['data']['country'],
                'country_iso_code' => $this->resource['data']['country_iso_code'],

                'kladr_id' => $this->resource['data']['area_kladr_id'],
                'fias_id' => $this->resource['data']['area_fias_id'],
                'name' => $this->resource['data']['area'],
                'type' => $this->resource['data']['area_type'],
                'type_full' => $this->resource['data']['area_type_full'],
                'name_with_type' => $this->resource['data']['area_with_type'],
            ],
        ];
    }
}
