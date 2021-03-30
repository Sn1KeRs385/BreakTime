<?php

namespace Database\Factories;

use App\Models\CustomerUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerUserFactory extends Factory
{
    protected $model = CustomerUser::class;

    public function definition()
    {
        return [
            'count' => $this->faker->numberBetween(1, 10),
        ];
    }

    public function isAccountReceived(): CustomerUserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'price_total' => $this->faker->randomFloat(2, 1, 999999),
                'account_received_at' => $this->faker->dateTime(),
            ];
        });
    }

    public function isAccountPaid(): CustomerUserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'price_paid' => $this->faker->randomFloat(2, 1, 999999),
                'account_paid_at' => $this->faker->dateTime(),
            ];
        });
    }

    public function isEnd(): CustomerUserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'end_at' => $this->faker->dateTime(),
            ];
        });
    }
}
