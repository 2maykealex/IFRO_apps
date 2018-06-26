<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(CourseTableSeeder::class);
        $this->call(ActivityTableSeeder::class);
        // $this->call(StateTableSeeder::class);
        // $this->call(CityTableSeeder::class);
        $this->call(PersonTableSeeder::class);
        $this->call(CoordinatorTableSeeder::class);
        $this->call(StudentTableSeeder::class);
    }
}
