<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'description' => $this->faker->text(),
        ];
    }

    public function isAccountReceived(): CustomerFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'price_total' => $this->faker->randomFloat(2, 1, 999999),
                'account_received_at' => $this->faker->dateTime(),
            ];
        });
    }

    public function isAccountPaid(): CustomerFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'price_paid' => $this->faker->randomFloat(2, 1, 999999),
                'account_paid_at' => $this->faker->dateTime(),
            ];
        });
    }

    public function isEnd(): CustomerFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'end_at' => $this->faker->dateTime(),
            ];
        });
    }
}
