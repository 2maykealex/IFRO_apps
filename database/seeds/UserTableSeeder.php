<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name'     => 'admin',
            'email'    => 'admin@ifro.edu.br',
            'password' => bcrypt('123456'),
            'image'    => '',
        ]);

        User::create([
            'name'     => 'Saulo',
            'email'    => 'saulo@ifro.edu.br',
            'password' => bcrypt('123456'),
            'image'    => '',
        ]);

        User::create([
            'name'     => 'Carlos',
            'email'    => 'carlos@especialista.com.br',
            'password' => bcrypt('123456'),
            'image'    => '',
        ]);

        User::create([
            'name'     => 'Mayke',
            'email'    => 'mayke.suporte@gmail.com',
            'password' => bcrypt('123456'),
            'image'    => '',
        ]);
    }
}
