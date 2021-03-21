<?php

namespace App\Http\Controllers\Api\V1;


use App\Helpers\JSON;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Place\AllRequest;
use App\Http\Requests\Api\V1\Place\DeleteRequest;
use App\Http\Requests\Api\V1\Place\StoreRequest;
use App\Http\Requests\Api\V1\Place\UpdateRequest;
use App\Http\Resources\Api\V1\Place\BaseResource;
use App\Models\Institution;
use App\Models\Place;
use Illuminate\Support\Arr;

class PlaceController extends Controller
{
    /**
     *  @OA\Get(
     *      path="/v1/places",
     *      operationId="V1PlaceControllerAll",
     *      summary="Список посадочных мест",
     *      tags={"Places"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1PlaceAllRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiV1PlaceBaseResource")),
     *  )
     */
    public function all(AllRequest $request)
    {
        $this->authorize('view', Institution::find($request->institution_id));

        $places = Place::query()
            ->where('institution_id', $request->institution_id)
            ->get();

        return JSON::getJson(BaseResource::collection($places));
    }

    /**
     *  @OA\Post(
     *      path="/v1/places",
     *      operationId="V1PlaceControllerStore",
     *      summary="Создание нового посадочного места",
     *      tags={"Places"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1PlaceStoreRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiV1PlaceBaseResource")),
     *  )
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $institution = Institution::find($data['institution_id']);

        $this->authorize('create', [Place::class, $institution]);

        $place = $institution->places()
            ->firstOrCreate(['name' => $data['name']]);

        return JSON::getJson(BaseResource::make($place));
    }

    /**
     *  @OA\Put(
     *      path="/v1/places",
     *      operationId="V1PlaceControllerUpdate",
     *      summary="Изменение существующего посадочного места",
     *      tags={"Places"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1PlaceUpdateRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiV1PlaceBaseResource")),
     *  )
     */
    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        $place = Place::with(['institution'])
            ->find($data['id']);

        $this->authorize('update', $place);

        $place->update(Arr::only($data, ['name']));

        return JSON::getJson(BaseResource::make($place));
    }

    /**
     *  @OA\Delete (
     *      path="/v1/places",
     *      operationId="V1PlaceControllerDelete",
     *      summary="Удаление существующего посадочного места",
     *      tags={"Places"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1PlaceDeleteRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(type="array", example="[]", @OA\Items())),
     *  )
     */
    public function delete(DeleteRequest $request)
    {
        $data = $request->validated();

        $place = Place::with(['institution'])
            ->find($data['id']);

        $this->authorize('delete', $place);

        $place->delete();

        return JSON::getJson();
    }
}
