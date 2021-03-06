<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'last_name' => $this->faker->name(),
            'first_name' => $this->faker->firstName(),
            'patronymic' => $this->faker->firstName(),
            'email' => $this->faker->email,
            'password' => bcrypt($this->faker->password()),
        ];
    }

    public function emailVerified(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => now(),
            ];
        });
    }
}
