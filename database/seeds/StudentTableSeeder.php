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
            'course_id'    => 2,
            'person_id'    => 1,
            'registration' => 987654,
        ]);
    }
}
