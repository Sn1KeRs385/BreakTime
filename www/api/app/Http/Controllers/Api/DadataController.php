<?php

namespace App\Http\Controllers\Api;


use App\Constants\Dadata\DadataBounds;
use App\Helpers\JSON;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dadata\Api\FindLocationRequest;
use App\Http\Resources\Dadata\Api\FindLocationAreaResource;
use App\Http\Resources\Dadata\Api\FindLocationCityResource;
use App\Http\Resources\Dadata\Api\FindLocationCountryResource;
use App\Http\Resources\Dadata\Api\FindLocationHouseResource;
use App\Http\Resources\Dadata\Api\FindLocationRegionResource;
use App\Http\Resources\Dadata\Api\FindLocationSettlementResource;
use App\Http\Resources\Dadata\Api\FindLocationStreetResource;
use App\Repositories\Api\DadataRepository;

class DadataController extends Controller
{
    protected DadataRepository $dadataRepository;

    public function __construct(DadataRepository $dadataRepository)
    {
        $this->dadataRepository = $dadataRepository;
    }

    /**
     *  @OA\Get(
     *      path="/dadata/find_location",
     *      operationId="ApiDadataControllerFindLocation",
     *      summary="Поиск субектов",
     *      tags={"Dadata"},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiDadataFindLocationRequest")),
     *
     *      @OA\Response(response=2001, description="Ответ - поиск страны (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/ApiDadataFindLocationCountryResource"))),
     *      @OA\Response(response=2002, description="Ответ - поиск региона (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/ApiDadataFindLocationRegionResource"))),
     *      @OA\Response(response=2003, description="Ответ - поиск района (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/ApiDadataFindLocationAreaResource"))),
     *      @OA\Response(response=2004, description="Ответ - поиск города (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/ApiDadataFindLocationCityResource"))),
     *      @OA\Response(response=2005, description="Ответ - поиск населенного пункта (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/ApiDadataFindLocationSettlementResource"))),
     *      @OA\Response(response=2006, description="Ответ - поиск улицы (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/ApiDadataFindLocationStreetResource"))),
     *      @OA\Response(response=2007, description="Ответ - поиск дома (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/ApiDadataFindLocationHouseResource"))),
     *  )
     */
    public function findLocation(FindLocationRequest $request)
    {
        $count = $request->input('count', 10);
        $kladrId = $request->input('find_in.kladr_id');
        $countryIsoCode = $request->input('find_in.country_iso_code');
        $bound = $request->input('bound');

        if(!$countryIsoCode || ($countryIsoCode && $bound === DadataBounds::COUNTRY)){
            $countryIsoCode = "*";
        }

        $suggestions = $this->dadataRepository->findLocation(
            $request->input('query'),
            $count,
            $request->bound,
            $kladrId,
            $countryIsoCode);

        switch($bound) {
            case DadataBounds::REGION:
                $suggestions = FindLocationRegionResource::collection($suggestions);
                break;
            case DadataBounds::AREA:
                $suggestions = FindLocationAreaResource::collection($suggestions);
                break;
            case DadataBounds::CITY:
                $suggestions = FindLocationCityResource::collection($suggestions);
                break;
            case DadataBounds::SETTLEMENT:
                $suggestions = FindLocationSettlementResource::collection($suggestions);
                break;
            case DadataBounds::STREET:
                $suggestions = FindLocationStreetResource::collection($suggestions);
                break;
            case DadataBounds::HOUSE:
                $suggestions = FindLocationHouseResource::collection($suggestions);
                break;
            default:
                $suggestions = FindLocationCountryResource::collection($suggestions);
                break;
        }

        return JSON::getJson($suggestions);
    }
}
