<?php

namespace App\Http\Requests\Api\V1\Tariff;

use App\Models\Service;
use App\Models\Tariff;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 *  @OA\Schema(schema="ApiV1TariffUpdateRequest",
 *      description="Тариф - изменение",
 *      type="object",
 *      required={"id", "name"},
 *      @OA\Property (property="id", example=1, type="integer", description="Идентификатор тарифа"),
 *      @OA\Property (property="name", type="string", maxLength=255, description="Название тарифа", example="Базовый"),
 *      @OA\Property (property="cost_visit", type="double", minimum=0, nullable=true, description="Стоимость входа", example=200.50),
 *      @OA\Property (property="cost_minimum", type="double", minimum=0, nullable=true, description="Минимальная стоимость", example=200.50),
 *      @OA\Property (property="cost_per_minute", type="double", minimum=0, nullable=true, description="Стоимость минуты", example=200.50),
 *      @OA\Property (property="timers", type="array",
 *          @OA\Items(type="object",
 *              @OA\Property (property="minute_from", type="int", minimum=0, description="С минуты", example=1),
 *              @OA\Property (property="minute_to", type="int", minimum=0, description="По минуту", example=10),
 *              @OA\Property (property="cost", type="float", minimum=0, description="Стоимость", example=10.50),
 *          )
 *      ),
 *  )
 */
class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => [
                'required',
                'int',
                Rule::exists('tariffs', 'id')
                    ->whereNull('deleted_at'),
            ],
            'name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('tariffs', 'name')
                    ->ignore($this->id)
                    ->where('institution_id', (Tariff::find($this->id)->institution_id ?? null)),
            ],
            'cost_visit' => 'sometimes|nullable|numeric|min:0',
            'cost_minimum' => 'sometimes|nullable|numeric|min:0',
            'cost_per_minute' => 'sometimes|nullable|numeric|min:0',
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
