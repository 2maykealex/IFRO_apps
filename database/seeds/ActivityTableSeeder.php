<?php

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::create([
            'descricao'     => 'Aplicação de projeto de pesquisa e apresentação de resultados, diferente daquele que configura 
                                Trabalho de Conclusão de Curso.',
            'CHAtividade'   => '10',
            'CHItem'        => '40',
        ]);

        Activity::create([
            'descricao'     => 'Apreciação de filmes relacionados à área de formação correspondente, comprovada por 
                                apresentação de resenha feita pelo aluno, que vincule o filme ao curso.',
            'CHAtividade'   => '2',
            'CHItem'        => '10',
        ]);

        Activity::create([
            'descricao'     => 'Colaboração nas atividades de consultoria na área do curso em que o aluno estuda.',
            'CHAtividade'   => '2',
            'CHItem'        => '10',
        ]);
    }
}
