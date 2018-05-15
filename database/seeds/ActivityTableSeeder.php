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

        Activity::create([
            'descricao'     => 'Comparecimento a lançamento de livros.',
            'CHAtividade'   => '1',
            'CHItem'        => '10',
        ]);

        Activity::create([
            'descricao'     => 'Estudo, com aprovação, de disciplinas extras àquelas definidas na matriz curricular do curso em que o aluno está matriculado',
            'CHAtividade'   => '5',
            'CHItem'        => '20',
        ]);

        Activity::create([
            'descricao'     => 'Exercício de monitoria na área de seu curso ou de qualquer curso oferecido pelo IFRO.',
            'CHAtividade'   => '1',
            'CHItem'        => '40',
        ]);

        Activity::create([
            'descricao'     => 'Leitura de livros extras aos do programa das disciplinas, comprovada por resenha feita pelo aluno, que vincule o livro ao curso.',
            'CHAtividade'   => '1',
            'CHItem'        => '20',
        ]);

        Activity::create([
            'descricao'     => 'Participação comprovada em evento que trate de temáticas relativas à área de formação do aluno (em comunicação oral, exposição de objetos de pesquisa ou como ouvinte).',
            'CHAtividade'   => '4',
            'CHItem'        => '20',
        ]);

        Activity::create([
            'descricao'     => 'Participação como membro de grupos de estudo.',
            'CHAtividade'   => '5',
            'CHItem'        => '10',
        ]); 
        
        Activity::create([
            'descricao'     => 'Participação em atividades de turismo de orientado.',
            'CHAtividade'   => '10', //ver isso
            'CHItem'        => '10',
        ]);

        Activity::create([
            'descricao'     => 'Participação em eventos artísticos, com canto, declamação, encenação teatral, coreografia.',
            'CHAtividade'   => '2',
            'CHItem'        => '20',
        ]); 

        Activity::create([
            'descricao'     => 'Participação, com certificado, em curso de formação complementar ou suplementar',
            'CHAtividade'   => '10',
            'CHItem'        => '40',
        ]); 
            
        Activity::create([
            'descricao'     => 'Participação, como atleta, nos jogos promovidos pelo IFRO ou de que o Campus participe formalmente.',
            'CHAtividade'   => '05',
            'CHItem'        => '20',
        ]); 

        Activity::create([
            'descricao'     => 'Participação, como ouvinte, de defesa de trabalhos de conclusão de curso, dentro ou fora do IFRO, quando houver temas de sua área de formação ou afins.',
            'CHAtividade'   => '1',
            'CHItem'        => '10',
        ]); 

        Activity::create([
            'descricao'     => 'Planejamento ou organização de evento relativo à área de formação do aluno, como autor, coautor ou colaborador.',
            'CHAtividade'   => '5',
            'CHItem'        => '20',
        ]); 

        Activity::create([
            'descricao'     => 'Publicação de texto próprio em revista, livro ou site aprovado pelo coordenador do curso.',
            'CHAtividade'   => '5',
            'CHItem'        => '40',
        ]); 

        Activity::create([
            'descricao'     => 'Realização certificada de curso de língua estrangeira.',
            'CHAtividade'   => '20',
            'CHItem'        => '40',
        ]); 

        Activity::create([
            'descricao'     => 'Realização de atividades como membro de colegiado do IFRO ou a ele relacionado diretamente.',
            'CHAtividade'   => '20',
            'CHItem'        => '40',
        ]); 

        Activity::create([
            'descricao'     => 'Realização de atividades gerais de representação do IFRO, por solicitação do diretor-geral do Campus.',
            'CHAtividade'   => '5',
            'CHItem'        => '20',
        ]); 

        Activity::create([
            'descricao'     => 'Visita comprovada a museus, feiras culturais, exposições, eventos relacionados à sua formação acadêmica e que não compreendam atividades programadas para as disciplinas do curso de que o aluno participa.',
            'CHAtividade'   => '1',
            'CHItem'        => '10',
        ]); 

        Activity::create([
            'descricao'     => 'Outras atividades, aceitas pelo Coordenador do Curso e que atendam aos princípios deste Regulamento.',
            'CHAtividade'   => '40',  //VER ISSO
            'CHItem'        => '40',
        ]); 
        
    }
}
