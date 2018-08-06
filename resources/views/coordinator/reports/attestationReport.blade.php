@extends('adminlte::coordinator')

@section('content_header')

    <ol class="breadcrumb">
        <li><a href="{{ URL::previous() }}">Voltar</a></li>
    </ol>


    <style media="print">
        .btnPrint {
        display: none;
        }
    </style>

    <script>
        .centralizar{
            margin-left: auto; 
            margin-right: auto;
            width: 6em;
        }
    </script>

    <script>
        function cont(){
            var conteudo = document.getElementById('print').innerHTML;
            tela_impressao = window.open('about:blank');
            tela_impressao.document.write(conteudo);
            tela_impressao.window.print();
            tela_impressao.window.close();
        }
    </script>

@stop

@section('content')

    <input class="btnPrint btn btn-warning" type="button" value="Imprimir relatório" onClick="window.print()"/>

    <div class="box-body">
        @include('admin.includes.alerts')        
        
        <p style="text-align:center;"><img src="{{ url('storage/images/logo_do_ifro AAC.jpg') }}" alt="Brasão do Brasil" width="100%"></p>

        <p style="text-align: center;">MINISTÉRIO DA EDUCAÇÃO</p>
        <p style="text-align: center;">INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DE RONDÔNIA</p>
        <p style="text-align: center;">CAMPUS ZONA NORTE</p>
        <p style="text-align: center;">ATESTADO DE CONCLUSÃO DE ATIVIDADES ACADÊMICAS COMPLEMENTARES</p>
        <p style="text-align: center;">Atesto que o aluna(o) <strong> {{ $student->person->name }}</strong>, matriculada(o) no Curso <strong>{{ $student->person->course->name }}</strong>, {{ $student->person->course->qtSem }}º período, turma <strong>{{ $student->group }}</strong>, deste <i>Campus</i>, cumpriu a carga horária das Atividades Acadêmicas Complementares, com aproveitamento suficiente, conforme a seguinte programação:</p>
        
        <br>

        <table class="table table-hover table-sm" style="" >

            <tbody >
                 <tr class="row">
                    <th class="">Item</th>
                    <th class="" colspan="2">Atividades Acadêmicas Complementares  </th>
                    <th class="">Local</th>
                    <th class="">Período</th>
                    <th class="">CH</th>
                    <!-- <th class="" colspan="2">Visto do Aluno</th> -->
                </tr>

                @Foreach ($activities as $key => $activity)
                   <?php 
                        if ($color=='#D8D8D8'){
                            $color = "000";
                        } else {
                            $color = "#D8D8D8";
                        }
                    ?>

                    @forelse ($certificates as $certificate)


                        @if ($certificate->activity_id == $key)
                            <tr class="row">                   <!-- style="background:{{ $color }};" -->
                                <td>{{ $key }}</td>
                                <td>{{ $certificate->description }}</td>
                                <td></td>
                                <td>{{ $certificate->local }}</td>
                                <td>{{ $certificate->period }}</td>
                                <td>{{ $certificate->chCertificate }} horas</td>
                                <!-- <td></td> -->
                            </tr>

                            <?php 
                                $count = $count + 1;
                                $soum = $soum + $certificate->chCertificate;
                                $idActivity = $certificate->activity_id; 
                            ?>
                        @endif                    
                    @empty
                    @endforelse
                @endforeach  
        
           
            <tr class="row">
                <td class="" colspan="4"><strong>TOTAL</strong></td>
                <td class=""></td>
                <td class=""><strong>{{ $soum }} horas</strong></td>
                <td class="" colspan="2"></td>
            </tr>
                
            
            </tbody>
         </table>
               <br>
               <br>

               <div class="row">
               
                        <div class="col-md-4">
                        
                        </div>

                        <div class="col-md-4">
                        
                        </div>

                        <div class="col-md-4">
                            <p style="text-align:right;">Porto Velho-RO, {{ $date }}</p>
                            <br>
                            <br>
                            <br>

                            <!-- <p style="text-align:center;">_________________________________________________</p> -->
                
                            <div style="text-align:center;">                            
                                <img src="{{ url('storage/signatures/'.$coordinator->signature) }}" class="img-fluid" alt="Responsive image" width="50%" >
                            </div>

                            <p style="text-align:center;">Coordenador do Curso de {{ $coordinator->person->course->name }}</p>
                        </div>     
               
               </div>

    </div>    
@stop



