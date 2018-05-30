<?php

use Illuminate\Database\Seeder;
use App\Models\Coordinator;

class CoordinatorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coordinator::create([
            'person_id'    => 1,
            'registration' => 123456789,
        ]);
    }
}
