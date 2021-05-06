<?php

namespace App\Http\Resources\Api\V1\Place;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(schema="ApiV1PlaceBaseResource",
 *      @OA\Property(property="id", type="int", example=1),
 *      @OA\Property(property="name", type="string", example="Стол 4"),
 *  )
 */
class BaseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
