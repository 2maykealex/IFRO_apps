<?php

use Illuminate\Database\Seeder;
use App\Models\UserProfile;

class UserProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserProfile::create([                 //definindo Regra para Admin
            'user_id'            => 1,
            'profile_access_id'  => 1,
        ]);

        UserProfile::create([                 //definindo Regra para Coordenador
            'user_id'            => 2,
            'profile_access_id'  => 2,
        ]);

        UserProfile::create([                 //definindo Regra para Alunos
            'user_id'            => 3,
            'profile_access_id'  => 3,
        ]);
        
        UserProfile::create([                 //definindo Regra para Alunos
            'user_id'            => 4,
            'profile_access_id'  => 3,
        ]);
    }
}
