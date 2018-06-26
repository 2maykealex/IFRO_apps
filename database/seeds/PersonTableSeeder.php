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
            'user_id'      => 1,            
            'course_id'    => 2,

            'name'         => 'Saulo',
            'cpf'          => '33333333333',


            // 'address'      => 'Rua Jacy Paraná',
            // 'number'       => '2742',
            // 'complement'   => 'Cond. Chico Torres, Apto 205',
            // 'neighborhood' => 'Roque',
            // 'zipCode'      => '76804430',
            
            // 'city_id'      => 1,
            
            'telefones'          => '69992461190',


        ]);


        Person::create([
            'user_id'      => 2,            
            'course_id'    => 2,

            'name'         => 'Carlos',
            'cpf'          => '22222222222',


            // 'address'      => 'Rua Jacy Paraná',
            // 'number'       => '2742',
            // 'complement'   => 'Cond. Chico Torres, Apto 205',
            // 'neighborhood' => 'Roque',
            // 'zipCode'      => '76804430',
            
            // 'city_id'      => 1,

            'telefones'          => '69992461190',


        ]);

        Person::create([
            'user_id'      => 3,            
            'course_id'    => 2,
            
            'name'         => 'Mayke Alex Miranda Plaça',
            'cpf'          => '73862789268',


            // 'address'      => 'Rua Jacy Paraná',
            // 'number'       => '2742',
            // 'complement'   => 'Cond. Chico Torres, Apto 205',
            // 'neighborhood' => 'Roque',
            // 'zipCode'      => '76804430',
            
            // 'city_id'      => 1,
            
            'telefones'          => '69992461190',


        ]);
    }
}
