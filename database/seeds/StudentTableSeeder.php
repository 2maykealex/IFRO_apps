<?php

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'person_id'    => 2,
            'registration' => 987654,
            'group'  => '20181066301A',
            'status' => 1,
        ]);

        Student::create([
            'person_id'    => 3,
            'registration' => 56784,
            'group'  => '20181066301A',
            'status' => 1,
        ]);
    }
}
