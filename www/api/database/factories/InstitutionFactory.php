<?php

namespace Database\Factories;

use App\Models\Institution;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstitutionFactory extends Factory
{
    protected $model = Institution::class;

    public function definition()
    {
        return [
            'name' => $this->faker->text(),
        ];
    }

    public function withLocation(): InstitutionFactory
    {
        return $this->state(function (array $attributes) {
            $location = Location::factory()
                ->withFiasId()
                ->typeHouse()
                ->create();

            return [
                'location_id' => $location->id,
            ];
        });
    }
}
