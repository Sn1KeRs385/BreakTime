<?php

namespace App\Http\Controllers\Api\V1;


use App\Helpers\JSON;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Tariff\AllRequest;
use App\Http\Requests\Api\V1\Tariff\DeleteRequest;
use App\Http\Requests\Api\V1\Tariff\StoreRequest;
use App\Http\Requests\Api\V1\Tariff\UpdateRequest;
use App\Http\Resources\Api\V1\Tariff\BaseResource;
use App\Models\Institution;
use App\Models\Tariff;

class TariffController extends Controller
{
    /**
     *  @OA\Get(
     *      path="/v1/tariffs",
     *      operationId="V1TariffControllerAll",
     *      summary="Список всех тарифов",
     *      tags={"Tariffs"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1TariffAllRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiV1TariffBaseResource")),
     *  )
     */
    public function all(AllRequest $request)
    {
        $this->authorize('view', Institution::find($request->institution_id));

        $tariffs = Tariff::query()
            ->where('institution_id', $request->institution_id)
            ->get();

        return JSON::getJson(BaseResource::collection($tariffs));
    }

    /**
     *  @OA\Post(
     *      path="/v1/tariffs",
     *      operationId="V1TariffControllerStore",
     *      summary="Создание нового тарифа",
     *      tags={"Tariffs"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1TariffStoreRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiV1TariffBaseResource")),
     *  )
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $institution = Institution::find($data['institution_id']);

        $this->authorize('create', [Tariff::class, $institution]);

        $tariff = $institution->tariffs()
            ->create([
                'name' => $data['name'],
                'cost_visit' => $data['cost_visit'],
                'cost_minimum' => $data['cost_minimum'],
                'cost_per_minute' => $data['cost_per_minute'],
            ]);

        if($request->has('timers')) {
            $timerIds = [];
            foreach ($request->timers as $timer) {
                $timer = $tariff->timers()
                    ->create([
                        'minute_from' => $timer['minute_from'],
                        'minute_to' => $timer['minute_to'],
                        'cost' => $timer['cost'],
                    ]);
                $timerIds[] = $timer->id;
            }
        }

        return JSON::getJson(BaseResource::make($tariff));
    }


    /**
     *  @OA\Put(
     *      path="/v1/tariffs",
     *      operationId="V1TariffControllerUpdate",
     *      summary="Изменение существующего тарифа",
     *      tags={"Tariffs"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1TariffUpdateRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(ref="#/components/schemas/ApiV1TariffBaseResource")),
     *  )
     */
    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        $tariff = Tariff::with(['institution'])
            ->find($data['id']);

        $this->authorize('update', $tariff);

        $tariff->update($data);

        if($request->has('timers')) {
            $timerIds = [];
            foreach ($request->timers as $timer) {
                $timer = $tariff->timers()
                    ->updateOrCreate([
                        'minute_from' => $timer['minute_from'],
                        'minute_to' => $timer['minute_to'],
                    ], [
                        'cost' => $timer['cost'],
                    ]);
                $timerIds[] = $timer->id;
            }
            $tariff->timers()
                ->whereNotIn('id', $timerIds)
                ->delete();
        }

        return JSON::getJson(BaseResource::make($tariff));
    }

    /**
     *  @OA\Delete (
     *      path="/v1/tariffs",
     *      operationId="V1TariffControllerDelete",
     *      summary="Удаление существующего тарифа",
     *      tags={"Tariffs"},
     *      security={{"api_auth":{}}},
     *      @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/ApiV1TariffDeleteRequest")),
     *
     *      @OA\Response(response=200, description="Ответ", @OA\JsonContent(type="array", example="[]", @OA\Items())),
     *  )
     */
    public function delete(DeleteRequest $request)
    {
        $data = $request->validated();

        $tariff = Tariff::with(['institution'])
            ->find($data['id']);

        $this->authorize('delete', $tariff);

        $tariff->delete();

        return JSON::getJson();
    }
}
