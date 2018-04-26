<?php

use Illuminate\Database\Seeder;
use App\Models\State;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create([
            'name'     => 'Rondônia',
            'initials'   => 'RO',
        ]);

        State::create([
            'name'     => 'São Paulo',
            'initials'   => 'SP',
        ]);

        State::create([
            'name'     => 'Distrito Federal',
            'initials'   => 'DF',
        ]);
    }
}
