<?php

namespace App\Http\Requests\Api\V1\Tariff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *  @OA\Schema(schema="ApiV1TariffStoreRequest",
 *      description="Тариф - создание",
 *      type="object",
 *      required={"institution_id", "name"},
 *      @OA\Property (property="institution_id", example=1, type="integer", description="Идентификатор заведения"),
 *      @OA\Property (property="name", type="string", maxLength=255, description="Название тарифа", example="Стандарт"),
 *      @OA\Property (property="cost_visit", type="double", minimum=0, nullable=true, description="Стоимость входа", example=200.50),
 *      @OA\Property (property="cost_minimum", type="double", minimum=0, nullable=true, description="Минимальная стоимость", example=200.50),
 *      @OA\Property (property="cost_per_minute", type="double", minimum=0, nullable=true, description="Стоимость минуты", example=200.50),
 *      @OA\Property (property="timers", type="array",
 *          @OA\Items(type="object",
 *              @OA\Property (property="minute_from", type="int", minimum=0, description="С минуты", example=1),
 *              @OA\Property (property="minute_to", type="int", minimum=0, description="По минуту", example=10),
 *              @OA\Property (property="cost", type="double", minimum=0, description="Стоимость", example=10.50),
 *          )
 *      ),
 *  )
 */
class StoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'institution_id' => [
                'required',
                'int',
                Rule::exists('institutions', 'id')
                    ->whereNull('deleted_at'),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tariffs', 'name')
                    ->where('institution_id', $this->institution_id),
            ],
            'cost_visit' => 'required|nullable|numeric|min:0',
            'cost_minimum' => 'required|nullable|numeric|min:0',
            'cost_per_minute' => 'required|nullable|numeric|min:0',
            'timers' => [
                'array',
                function($attribute, $value, $fail){
                    $existsIntervals = collect([]);
                    foreach($value as $timer) {
                        $intervalStartExists = $existsIntervals
                            ->where('minute_from', '<=', $timer['minute_from'])
                            ->Where('minute_to', '>=', $timer['minute_from'])
                            ->first();
                        $intervalEndExists = $existsIntervals
                            ->where('minute_from', '<=', $timer['minute_to'])
                            ->Where('minute_to', '>=', $timer['minute_to'])
                            ->first();
                        if($intervalStartExists || $intervalEndExists){
                            $fail(__('custom-validation.intervals_intersect'));
                        }
                        $existsIntervals->push([
                            'minute_from' => $timer['minute_from'],
                            'minute_to' => $timer['minute_to'],
                        ]);
                    }
                },
            ],
            'timers.*' => 'sometimes|required|array',
            'timers.*.minute_from' => 'required|int|min:0',
            'timers.*.minute_to' => 'required|int|min:0',
            'timers.*.cost' => 'required|numeric|min:0',
        ];
    }
}
