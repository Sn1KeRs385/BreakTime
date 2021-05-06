<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(schema="ApiV1InstitutionResource",
 *      @OA\Property(property="id", type="int", example=1),
 *      @OA\Property(property="name", type="string", example="Кафе у дороги"),
 *      @OA\Property(property="address", type="string", example="обл. Тюменская, г. Тюмень, ул. Мельникайте, д. 136"),
 *  )
 */
class InstitutionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
        ];
    }
}
