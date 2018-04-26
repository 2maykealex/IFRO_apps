<?php

use Illuminate\Database\Seeder;
use App\Models\Person;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Person::create([
            'user_id'      => '1',
            'name'         => 'Mayke Alex Miranda Plaça',

            'address'      => 'Rua Jacy Paraná',
            'number'       => '2742',
            'complement'   => 'Cond. Chico Torres, Apto 205',
            'neighborhood' => 'Roque',
            'zipCode'      => '76804430',
            
            'city_id'      => 1,
            
            'tel'          => '',
            'cel'          => '69992461190',


        ]);
    }
}
