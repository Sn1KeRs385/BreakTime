<?php

namespace Database\Seeders;

use App\Constants\LocationTypes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationTypeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $values = LocationTypes::getConstants();

        foreach($values as $name => $id){
            DB::table('location_types')
                ->updateOrInsert(['id' => $id], ['name' => $name]);
        }
    }
}
