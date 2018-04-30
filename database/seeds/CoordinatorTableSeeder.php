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
            'course_id'    => 2,
            'person_id'    => 1,
            'registration' => 123456789,
        ]);

        Coordinator::create([
            'course_id'    => 3,
            'person_id'    => 2,
            'registration' => 456738490,
        ]);
    }
}
