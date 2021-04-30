<?php

namespace App\Http\Resources\Api\V1\Tariff;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(schema="ApiV1TariffBaseResource",
 *      @OA\Property(property="id", type="int", example=1),
 *      @OA\Property(property="name", type="string", example="Студенческий"),
 *      @OA\Property(property="cost_visit", type="double", nullable=true, example=200.50),
 *      @OA\Property(property="cost_minimum", type="double", nullable=true, example=200.50),
 *      @OA\Property(property="cost_per_minute", type="double", nullable=true, example=200.50),
 *  )
 */
class BaseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cost_visit' => $this->cost_visit,
            'cost_minimum' => $this->cost_minimum,
            'cost_per_minute' => $this->cost_per_minute,
        ];
    }
}
