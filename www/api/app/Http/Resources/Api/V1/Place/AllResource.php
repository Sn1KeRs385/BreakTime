<?php

namespace App\Http\Resources\Api\V1\Place;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(schema="ApiV1PlaceAllResource",
 *      @OA\Property(property="id", type="int", example=1),
 *      @OA\Property(property="name", type="string", example="У окна"),
 *  )
 */
class AllResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
