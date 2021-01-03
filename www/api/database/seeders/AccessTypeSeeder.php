<?php

namespace Database\Seeders;

use App\Constants\AccessTypes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessTypeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $values = AccessTypes::getConstants();

        foreach($values as $name => $id){
            DB::table('access_types')
                ->updateOrInsert(['id' => $id], ['name' => $name]);
        }
    }
}
