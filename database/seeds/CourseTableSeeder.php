<?php

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'area_id'     => 1,
            'name' => 'Gestão Comercial',
            'qtSem' => 5,
            'chCourse' => 1734 ,
            'modalidade' => 'Curso Superior de Tecnologia',
        ]);

        Course::create([
            'area_id'     => 2,
            'name' => 'Técnico em Informática para Internet Subsequente ao Ensino Médio',
            'qtSem' => 3,
            'chCourse' => 1200 ,
            'modalidade' => 'Subsequente ao Ensino  Médio, presencial',
        ]);

        Course::create([
            'area_id'     => 2,
            'name' => 'Técnico em Finanças',
            'qtSem' => 3,
            'chCourse' => 1150 ,
            'modalidade' => 'Subsequente ao ensino médio, presencial',
        ]);
    }
}
