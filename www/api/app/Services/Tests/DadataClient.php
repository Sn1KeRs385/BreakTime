<?php

namespace App\Services\Tests;

use Dadata\Settings;

class DadataClient extends \Dadata\DadataClient
{
    protected static array $findByIdAnswer = [];

    public function __construct($token, $secret)
    {
        parent::__construct('fakeToken', 'fakeSecret');
    }

    public static function setFindByIdAnswer(?array $answer = null, ?int $count = null): array {
        if($answer) {
            self::$findByIdAnswer = $answer;
        } else {
            $faker = Faker::getFaker();
            self::$findByIdAnswer = [];
            if(!$count || $count < 1){
                $count = rand(1, 50);
            }
            for($i = 0; $i < $count; $i++){
                self::$findByIdAnswer[] = [
                    'value' => $faker->text(100),
                    'unrestricted_value' => $faker->text(100),
                    'data' => [
                        'postal_code' => $faker->numberBetween(100000, 999999),
                        'country' => $faker->text(20),
                        'country_iso_code' => $faker->text(5),
                        'federal_district' => $faker->text(20),

                        'region_fias_id' => $faker->uuid,
                        'region_kladr_id' => $faker->uuid,
                        'region_iso_code' => $faker->text(10),
                        'region_with_type' => $faker->text(20),
                        'region_type' => $faker->text(5),
                        'region_type_full' => $faker->text(15),
                        'region' => $faker->text(20),

                        'area_fias_id' => $faker->uuid,
                        'area_kladr_id' => $faker->uuid,
                        'area_with_type' => $faker->text(20),
                        'area_type' => $faker->text(5),
                        'area_type_full' => $faker->text(15),
                        'area' => $faker->text(20),

                        'city_fias_id' => $faker->uuid,
                        'city_kladr_id' => $faker->uuid,
                        'city_with_type' => $faker->text(20),
                        'city_type' => $faker->text(5),
                        'city_type_full' => $faker->text(15),
                        'city' => $faker->text(20),

                        'settlement_fias_id' => $faker->uuid,
                        'settlement_kladr_id' => $faker->uuid,
                        'settlement_with_type' => $faker->text(20),
                        'settlement_type' => $faker->text(5),
                        'settlement_type_full' => $faker->text(15),
                        'settlement' => $faker->text(20),

                        'street_fias_id' => $faker->uuid,
                        'street_kladr_id' => $faker->uuid,
                        'street_with_type' => $faker->text(20),
                        'street_type' => $faker->text(5),
                        'street_type_full' => $faker->text(15),
                        'street' => $faker->text(20),

                        'house_fias_id' => $faker->uuid,
                        'house_kladr_id' => $faker->uuid,
                        'house_type' => $faker->text(5),
                        'house_type_full' => $faker->text(15),
                        'house' => $faker->text(20),
                    ],
                ];
            }
        }
        return self::$findByIdAnswer;
    }

    public function findById($name, $query, $count = Settings::SUGGESTION_COUNT, $kwargs = [])
    {
        return array_slice(self::$findByIdAnswer, 0, $count, true);
    }
}
