<?php

namespace App\Http\Controllers;


use App\Constants\Dadata\DadataBounds;
use App\Helpers\JSON;
use App\Http\Requests\Dadata\FindLocationRequest;
use App\Http\Resources\Dadata\FindLocationAreaResource;
use App\Http\Resources\Dadata\FindLocationCityResource;
use App\Http\Resources\Dadata\FindLocationCountryResource;
use App\Http\Resources\Dadata\FindLocationHouseResource;
use App\Http\Resources\Dadata\FindLocationRegionResource;
use App\Http\Resources\Dadata\FindLocationSettlementResource;
use App\Http\Resources\Dadata\FindLocationStreetResource;
use App\Repositories\DadataRepository;

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
     *      operationId="DadataControllerFindLocation",
     *      summary="Поиск субектов",
     *      tags={"Dadata"},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/DadataFindLocationRequest")),
     *
     *      @OA\Response(response=2001, description="Ответ - поиск страны (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/DadataFindLocationCountryResource"))),
     *      @OA\Response(response=2002, description="Ответ - поиск региона (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/DadataFindLocationRegionResource"))),
     *      @OA\Response(response=2003, description="Ответ - поиск района (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/DadataFindLocationAreaResource"))),
     *      @OA\Response(response=2004, description="Ответ - поиск города (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/DadataFindLocationCityResource"))),
     *      @OA\Response(response=2005, description="Ответ - поиск населенного пункта (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/DadataFindLocationSettlementResource"))),
     *      @OA\Response(response=2006, description="Ответ - поиск улицы (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/DadataFindLocationStreetResource"))),
     *      @OA\Response(response=2007, description="Ответ - поиск дома (код 200)", @OA\JsonContent(@OA\Items(ref="#/components/schemas/DadataFindLocationHouseResource"))),
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
