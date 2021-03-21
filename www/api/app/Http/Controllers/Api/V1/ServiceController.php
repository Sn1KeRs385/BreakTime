<?php

namespace App\Http\Controllers\Api\V1;


use App\Helpers\JSON;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Service\AllRequest;
use App\Http\Requests\Api\V1\Service\DeleteRequest;
use App\Http\Requests\Api\V1\Service\StoreRequest;
use App\Http\Requests\Api\V1\Service\UpdateRequest;
use App\Http\Resources\Api\V1\Service\BaseResource;
use App\Models\Institution;
use App\Models\Service;
use Illuminate\Support\Arr;

class ServiceController extends Controller
{
    /**
     *  @OA\Get(
     *      path="/v1/services",
     *      operationId="V1ServiceControllerAll",
     *      summary="Список всех товаров/услуг",
     *      tags={"Services"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1ServiceAllRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiV1ServiceBaseResource")),
     *  )
     */
    public function all(AllRequest $request)
    {
        $this->authorize('view', Institution::find($request->institution_id));

        $services = Service::query()
            ->where('institution_id', $request->institution_id)
            ->get();

        return JSON::getJson(BaseResource::collection($services));
    }

    /**
     *  @OA\Post(
     *      path="/v1/services",
     *      operationId="V1ServiceControllerStore",
     *      summary="Создание нового товара/услуги",
     *      tags={"Services"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1ServiceStoreRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiV1ServiceBaseResource")),
     *  )
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $institution = Institution::find($data['institution_id']);

        $this->authorize('create', [Service::class, $institution]);

        $service = $institution->services()
            ->firstOrCreate([
                'name' => $data['name']
            ], [
                'price' => $data['price']
            ]);

        return JSON::getJson(BaseResource::make($service));
    }


    /**
     *  @OA\Put(
     *      path="/v1/services",
     *      operationId="V1ServiceControllerUpdate",
     *      summary="Изменение существующего товара/услуги",
     *      tags={"Services"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1ServiceUpdateRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiV1ServiceBaseResource")),
     *  )
     */
    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        $service = Service::with(['institution'])
            ->find($data['id']);

        $this->authorize('update', $service);

        $service->update(Arr::only($data, ['name', 'price']));

        return JSON::getJson(BaseResource::make($service));
    }

    /**
     *  @OA\Delete (
     *      path="/v1/services",
     *      operationId="V1ServiceControllerDelete",
     *      summary="Удаление существующего товара/услуги",
     *      tags={"Services"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1ServiceDeleteRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(type="array", example="[]", @OA\Items())),
     *  )
     */
    public function delete(DeleteRequest $request)
    {
        $data = $request->validated();

        $place = Service::with(['institution'])
            ->find($data['id']);

        $this->authorize('delete', $place);

        $place->delete();

        return JSON::getJson();
    }
}
