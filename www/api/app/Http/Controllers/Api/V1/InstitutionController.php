<?php

namespace App\Http\Controllers\Api\V1;


use App\Constants\LocationTypes;
use App\Exceptions\Auth\LocationNotHouseTypeException;
use App\Helpers\JSON;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Institution\StoreRequest;
use App\Http\Resources\Api\V1\InstitutionResource;
use App\Repositories\Api\DadataRepository;
use App\Repositories\Api\V1\InstitutionRepository;
use App\Services\Api\V1\InstitutionService;
use Illuminate\Support\Facades\Auth;

class InstitutionController extends Controller
{
    protected InstitutionRepository $institutionRepository;
    protected InstitutionService $institutionService;
    protected DadataRepository $dadataRepository;

    public function __construct(
        InstitutionRepository $institutionRepository,
        InstitutionService $institutionService,
        DadataRepository $dadataRepository
    ) {
        $this->institutionRepository = $institutionRepository;
        $this->institutionService = $institutionService;
        $this->dadataRepository = $dadataRepository;
    }

    /**
     *  @OA\Post(
     *      path="/v1/institutions/store",
     *      operationId="V1InstitutionControllerStore",
     *      summary="Создание нового заведения",
     *      tags={"Institutions"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1InstitutionStoreRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiV1InstitutionResource")),
     *      @OA\Response(response=4221, description="Ошибка 'LOCATION_NOT_HOUSE_TYPE' (код 422)", @OA\JsonContent(ref="#/components/schemas/ApiLocationNotHouseTypeException")),
     *      @OA\Response(response=4222, description="Ошибка 'INSTITUTION_ALREADY_EXISTS' (код 422)", @OA\JsonContent(ref="#/components/schemas/ApiInstitutionAlreadyExistsException")),
     *      @OA\Response(response=404, description="Ошибка 'LOCATION_NOT_FOUND_IN_DADATA'", @OA\JsonContent(ref="#/components/schemas/ApiDadataLocationNotFoundInDadataException")),
     *  )
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $location = $this->dadataRepository->getLocationByFiasAndKlad($data['fias_id'], $data['kladr_id']);

        if($location->type_id !== LocationTypes::HOUSE){
            throw new LocationNotHouseTypeException();
        }

        $institution = $this->institutionService->store($data['name'], $location, Auth::user());

        return JSON::getJson(InstitutionResource::make($institution));
    }
}
