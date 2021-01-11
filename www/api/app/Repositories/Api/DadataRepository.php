<?php

namespace App\Repositories\Api;


use App\Constants\Dadata\DadataSuggestTypes;
use Dadata\DadataClient;

class DadataRepository
{
    protected DadataClient $dadataClient;

    public function __construct()
    {
        $token = config('dadata.api_settings.token');
        $secret = config('dadata.api_settings.secret');
        $this->dadataClient = new DadataClient($token, $secret);
    }

    public function findLocation(string $query, int $count, string $bound, ?string $kladrId = null, ?string $countryIsoCode = null)
    {
        $args = [
            'from_bound' => ['value' => $bound],
            'to_bound' => ['value' => $bound],
        ];
        if($kladrId || $countryIsoCode){
            $args['locations'] = [];
            if($kladrId){
                $args['locations'][] = [
                    'kladr_id' => $kladrId
                ];
            } elseif($countryIsoCode) {
                $args['locations'][] = [
                    'country_iso_code' => $countryIsoCode
                ];
            }
        }
        return $this->dadataClient->suggest(DadataSuggestTypes::ADDRESS, $query, $count, $args);
    }
}
