<?php

namespace App\Http\Resources\Api\Auth;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *  @OA\Schema(schema="ApiAuthTokenResource",
 *      @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJS"),
 *      @OA\Property(property="token_type", type="string", example="Bearer"),
 *      @OA\Property(property="expires_at", type="integer", example=1638621401),
 *  )
 */
class TokenResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'access_token' => $this->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($this->token->expires_at)->timestamp,
        ];
    }
}
