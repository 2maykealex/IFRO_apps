<?php

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create([
            'descricao'     => 'Gestão e Negócios',
        ]);

        Area::create([
            'descricao'     => 'Informação e Comunicação',
        ]);
    }
}
