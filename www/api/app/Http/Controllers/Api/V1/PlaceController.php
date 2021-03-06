<?php

namespace App\Http\Controllers\Api\V1;


use App\Helpers\JSON;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Place\AllRequest;
use App\Http\Resources\Api\V1\Place\AllResource;
use App\Models\Institution;
use App\Models\Place;
use App\Repositories\Api\V1\PlaceRepository;
use App\Services\Api\V1\PlaceService;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    protected PlaceRepository $placeRepository;
    protected PlaceService $placeService;

    public function __construct(
        PlaceRepository $placeRepository,
        PlaceService $placeService
    ) {
        $this->placeRepository = $placeRepository;
        $this->placeService = $placeService;
    }

    /**
     *  @OA\Get(
     *      path="/v1/places",
     *      operationId="V1PlaceControllerAll",
     *      summary="Список посадочных мест",
     *      tags={"Places"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1PlaceAllRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiV1PlaceAllResource")),
     *  )
     */
    public function all(AllRequest $request)
    {
        $this->authorize('view', Institution::find($request->institution_id));

        $places = Place::query()
            ->where('institution_id', $request->institution_id)
            ->get();

        return JSON::getJson(AllResource::collection($places));
    }
}