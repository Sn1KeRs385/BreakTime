<?php

namespace App\Repositories\Api;


use App\Constants\Dadata\DadataBounds;
use App\Constants\Dadata\DadataSuggestTypes;
use App\Constants\LocationTypes;
use App\Exceptions\Api\Dadata\LocationNotFoundInDadataException;
use App\Models\Location;
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

    public function findById(string $id, int $count = 1)
    {
        return $this->dadataClient->findById(DadataSuggestTypes::ADDRESS, $id, $count);
    }

    public function getLocationByFiasAndKlad(string $fiasId, string $kladrId): Location
    {
        $location = Location::firstWhere([
            'kladr_id' => $kladrId,
            'fias_id' => $fiasId,
        ]);

        if(!$location){
            $dadataResponse = $this->findById($fiasId, 1);
            if(count($dadataResponse) === 0){
                throw new LocationNotFoundInDadataException();
            }
            $locationData = $dadataResponse[0]['data'];
            $parent = null;

            foreach(DadataBounds::PARSE_ORDER_WITH_LOCATION_TYPES as $parseKey => $typeId){
                if($locationData["{$parseKey}_fias_id"] && $locationData["{$parseKey}_kladr_id"]){
                    $parent = Location::updateOrCreate([
                        'kladr_id' => $locationData["{$parseKey}_kladr_id"],
                    ], [
                        'type_id' => $typeId,
                        'prefix' => $locationData["{$parseKey}_type"],
                        'name' => $locationData["{$parseKey}"],
                        'fias_id' => $locationData["{$parseKey}_fias_id"],
                        'parent_id' => $parent->id ?? null,
                    ]);
                    if($locationData["{$parseKey}_kladr_id"] === $kladrId && $locationData["{$parseKey}_fias_id"] === $fiasId){
                        return $parent;
                    }
                }
            }

        }

        if(!$location){
            throw new LocationNotFoundInDadataException();
        }

        return $location;
    }
}
