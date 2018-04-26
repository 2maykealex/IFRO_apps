<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'state_id'     => '1',
            'name'   => 'Porto Velho',
        ]);

        City::create([
            'state_id'     => '1',
            'name'   => 'Candeias do Jamari',
        ]);
    }
}
