<?php

namespace App\Http\Resources\Api\V1\Service;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(schema="ApiV1ServiceBaseResource",
 *      @OA\Property(property="id", type="int", example=1),
 *      @OA\Property(property="name", type="string", example="Пицца"),
 *      @OA\Property(property="price", type="double", example=200.50),
 *  )
 */
class BaseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => round($this->price, 2),
        ];
    }
}
