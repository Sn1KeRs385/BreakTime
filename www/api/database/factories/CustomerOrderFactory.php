<?php

namespace Database\Factories;

use App\Models\CustomerOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerOrderFactory extends Factory
{
    protected $model = CustomerOrder::class;

    public function definition()
    {
        return [
            'count' => $this->faker->numberBetween(1, 10),
        ];
    }
}
