<?php

namespace Database\Factories;

use App\Models\Tariff;
use App\Models\TariffTimer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TariffFactory extends Factory
{
    protected $model = Tariff::class;

    public function definition()
    {
        return [
            'name' => $this->faker->text(),
        ];
    }

    public function withCostVisit(): TariffFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'cost_visit' => $this->faker->randomFloat(2, 1, 999999),
            ];
        });
    }

    public function withCostMinimum(): TariffFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'cost_minimum' => $this->faker->randomFloat(2, 1, 999999),
            ];
        });
    }

    public function withCostPerMinute(): TariffFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'cost_per_minute' => $this->faker->randomFloat(2, 1, 999999),
            ];
        });
    }

    public function withTimers(): TariffFactory
    {
        return $this->afterCreating(function (Tariff $tariff) {
            $numberOfTimers = rand(1, 3);
            $minuteFrom = 0;
            for($i = 0; $i < $numberOfTimers; $i++){
                $minuteTo = rand(5, 10) + $minuteFrom;
                TariffTimer::factory()
                    ->create([
                        'tariff_id' => $tariff->id,
                        'minute_from' => $minuteFrom,
                        'minute_to' => $minuteTo,
                    ]);
                $minuteFrom = $minuteTo + 1;
            }
        });
    }
}
