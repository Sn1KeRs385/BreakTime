<?php

namespace App\Http\Resources\Api\Dadata;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(schema="ApiDadataFindLocationHouseResource",
 *      @OA\Property(property="value", type="string", description="Адрес одной строкой", example="Саратовская обл, Энгельсский р-н, село Березовка, ул Им А.Ф.Михеева, д 2/1"),
 *      @OA\Property(property="unrestricted_value", type="string", description="Адрес одной строкой(полный, с инедксом)", example="413154, Саратовская обл, Энгельсский р-н, село Березовка, ул Им А.Ф.Михеева, д 2/1"),
 *      @OA\Property(property="data", type="object",
 *          @OA\Property(property="country", type="string", description="Страна", example="Россия"),
 *          @OA\Property(property="country_iso_code", type="string", description="ISO-код страны (двухсимвольный)", example="RU"),
 *          @OA\Property(property="kladr_id", type="string", description="Код КЛАДР", example="6403900000400080016"),
 *          @OA\Property(property="fias_id", type="string", description="Код ФИАС", example="909a442e-8b06-4fab-af27-26c2601fa407"),
 *          @OA\Property(property="name", type="string", description="Название", example="2/1"),
 *          @OA\Property(property="type", type="string", description="Тип (сокращенный)", example="д"),
 *          @OA\Property(property="type_full", type="string", description="Тип", example="дом"),
 *          @OA\Property(property="postal_code", type="string", description="Почтовый индекс", example="413154"),
 *      ),
 *  )
 */
class FindLocationHouseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'value' => $this->resource['value'],
            'unrestricted_value' => $this->resource['unrestricted_value'],
            'data' => [
                'country' => $this->resource['data']['country'],
                'country_iso_code' => $this->resource['data']['country_iso_code'],

                'kladr_id' => $this->resource['data']['house_kladr_id'],
                'fias_id' => $this->resource['data']['house_fias_id'],
                'name' => $this->resource['data']['house'],
                'type' => $this->resource['data']['house_type'],
                'type_full' => $this->resource['data']['house_type_full'],

                'postal_code' => $this->resource['data']['postal_code'],
            ],
        ];
    }
}
