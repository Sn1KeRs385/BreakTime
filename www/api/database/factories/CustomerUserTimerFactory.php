<?php

namespace Database\Factories;

use App\Models\CustomerUserTimer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerUserTimerFactory extends Factory
{
    protected $model = CustomerUserTimer::class;

    public function definition()
    {
        return [
            'start_at' => $this->faker->dateTime(),
        ];
    }

    public function isEnd(): CustomerUserTimerFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'end_at' => $this->faker->dateTime(),
            ];
        });
    }
}
