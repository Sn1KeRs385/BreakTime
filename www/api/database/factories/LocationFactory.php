<?php

namespace Database\Factories;

use App\Constants\LocationTypes;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition()
    {
        return [
            'prefix' => $this->faker->randomLetter,
            'name' => $this->faker->text(),
            'kladr_id' => $this->faker->unique()->uuid,
        ];
    }

    public function withFiasId(): LocationFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'fias_id' => $this->faker->unique()->uuid,
            ];
        });
    }

    public function typeRegion(): LocationFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'type_id' => LocationTypes::REGION,
            ];
        });
    }

    public function typeArea(): LocationFactory
    {
        return $this->state(function (array $attributes) {
            $locationRegion = Location::factory()
                ->withFiasId()
                ->typeRegion()
                ->create();

            return [
                'type_id' => LocationTypes::AREA,
                'parent_id' => $locationRegion->id,
            ];
        });
    }

    public function typeCity(): LocationFactory
    {
        return $this->state(function (array $attributes) {
            $locationArea = Location::factory()
                ->withFiasId()
                ->typeArea()
                ->create();

            return [
                'type_id' => LocationTypes::CITY,
                'parent_id' => $locationArea->id,
            ];
        });
    }

    public function typeSettlement(): LocationFactory
    {
        return $this->state(function (array $attributes) {
            $locationCity = Location::factory()
                ->withFiasId()
                ->typeCity()
                ->create();

            return [
                'type_id' => LocationTypes::SETTLEMENT,
                'parent_id' => $locationCity->id,
            ];
        });
    }

    public function typeStreet(): LocationFactory
    {
        return $this->state(function (array $attributes) {
            $locationSettlement = Location::factory()
                ->withFiasId()
                ->typeSettlement()
                ->create();

            return [
                'type_id' => LocationTypes::STREET,
                'parent_id' => $locationSettlement->id,
            ];
        });
    }

    public function typeHouse(): LocationFactory
    {
        return $this->state(function (array $attributes) {
            $locationHouse = Location::factory()
                ->withFiasId()
                ->typeStreet()
                ->create();

            return [
                'type_id' => LocationTypes::HOUSE,
                'parent_id' => $locationHouse->id,
            ];
        });
    }
}
