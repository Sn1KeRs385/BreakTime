<?php

namespace App\Services\Tests;

use Faker\Generator;
use Illuminate\Foundation\Testing\WithFaker;

class Faker
{
    use WithFaker;

    public static function getFaker(): Generator{
        $fakerClass = app(self::class);
        return $fakerClass->faker ?? $fakerClass->makeFaker();
    }
}
