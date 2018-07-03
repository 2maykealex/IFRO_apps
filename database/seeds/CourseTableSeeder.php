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
            'area_id'     => 1,
            'name' => 'Gestão Pública',
            'qtSem' => 5,
            'chCourse' => 2500 ,
            'modalidade' => 'Curso Superior de Tecnologia',
        ]);

        Course::create([
            'area_id'     => 2,
            'name' => 'Redes de Computadores',
            'qtSem' => 6,
            'chCourse' => 2500 ,
            'modalidade' => 'Curso Superior de Tecnologia',
        ]);

        
    }
}
