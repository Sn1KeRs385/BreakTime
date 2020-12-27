<?php

namespace App\Http\Resources\Dadata;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(schema="DadataFindLocationSettlementResource",
 *      @OA\Property(property="value", type="string", description="Адрес одной строкой", example="Саратовская обл, Энгельсский р-н, село Березовка"),
 *      @OA\Property(property="unrestricted_value", type="string", description="Адрес одной строкой(полный, с инедксом)", example="413154, Саратовская обл, Энгельсский р-н, село Березовка"),
 *      @OA\Property(property="data", type="object",
 *          @OA\Property(property="country", type="string", description="Страна", example="Россия"),
 *          @OA\Property(property="country_iso_code", type="string", description="ISO-код страны (двухсимвольный)", example="RU"),
 *          @OA\Property(property="kladr_id", type="string", description="Код КЛАДР", example="6403900000400"),
 *          @OA\Property(property="name", type="string", description="Название", example="Березовка"),
 *          @OA\Property(property="type", type="string", description="Тип (сокращенный)", example="с"),
 *          @OA\Property(property="type_full", type="string", description="Тип", example="село"),
 *          @OA\Property(property="name_with_type", type="string", description="Название с типом", example="село Березовка"),
 *          @OA\Property(property="postal_code", type="string", description="Почтовый индекс", example="413154"),
 *      ),
 *  )
 */
class FindLocationSettlementResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'value' => $this->resource['value'],
            'unrestricted_value' => $this->resource['unrestricted_value'],
            'data' => [
                'country' => $this->resource['data']['country'],
                'country_iso_code' => $this->resource['data']['country_iso_code'],

                'kladr_id' => $this->resource['data']['settlement_kladr_id'],
                'name' => $this->resource['data']['settlement'],
                'type' => $this->resource['data']['settlement_type'],
                'type_full' => $this->resource['data']['settlement_type_full'],
                'name_with_type' => $this->resource['data']['settlement_with_type'],

                'postal_code' => $this->resource['data']['postal_code'],
            ],
        ];
    }
}
