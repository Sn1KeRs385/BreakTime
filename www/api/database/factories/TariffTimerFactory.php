<?php

namespace Database\Factories;

use App\Models\TariffTimer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TariffTimerFactory extends Factory
{
    protected $model = TariffTimer::class;

    public function definition()
    {
        return [
            'cost' => $this->faker->randomFloat(2, 1, 999999),
        ];
    }
}
