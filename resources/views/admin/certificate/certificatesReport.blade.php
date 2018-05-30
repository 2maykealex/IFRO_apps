@extends('adminlte::page')

@section('content_header')
    <h1>Certificados aprovados</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        
    </ol>

    <script>
        .centralizar{
            margin-left: auto; 
            margin-right: auto;
            width: 6em;
        }
    </script>

@stop

@section('content')
    <div class="box-body">
        @include('admin.includes.alerts')
          
        
        
        <img src="{{ url('storage/images/brasao.jpeg') }}" alt="" width="8%">

        <p style="text-align: center;">MINISTÉRIO DA EDUCAÇÃO</p>
        <p style="text-align: center;">INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DE RONDÔNIA</p>
        <p style="text-align: center;">CAMPUS ZONA NORTE</p>

        <p style="text-align: center;">ATESTADO DE CONCLUSÃO DE ATIVIDADES ACADÊMICAS COMPLEMENTARES</p>

        <p style="text-align: center;">Atesto que o aluna(o) {{ $person->name }}, matriculada(o) no Curso Superior de Tecnologia em Gestão Pública, _____período, turma_______, deste <i>Campus</i>, cumpriu a carga horária das Atividades Acadêmicas Complementares, com aproveitamento suficiente, conforme a seguinte programação</p>
        
        <br>

			

<table class="table table-hover" style="">

            <tbody>
                 <tr class="row">
                    <td class="">Item</td>
                    <td class="" colspan="2">Atividades Acadêmicas Complementares  </td>
                    <td class="">Local</td>
                    <td class="">Período</td>
                    <td class="">Carga Horária</td>
                    <td class="" colspan="2">Visto do Aluno</td>
                </tr>
                @Foreach ($activities as $key => $activity)
                    @forelse ($certificates as $certificate)
                        @if ($certificate->activity_id == $key)
                            <tr class="row">
                                <td class="">{{ $key }}</td>
                                <td class="">{{ $certificate->description }}</td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class="">{{ $certificate->chCertificate }}</td>
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
                    <td class="" colspan="4">TOTAL</td>
                    <td class=""></td>
                    <td class="">{{ $soum }}</td>
                    <td class="" colspan="2"></td>
            </tr>
                
            <tr class="row">
                    <td class="" colspan="4">PARCIAL</td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class="" colspan="2"></td>
            </tr>
            </tbody>
    </table>
               <br>

                <p>Porto Velho-RO, __ de ____ de 2018</p>
                <br>

                <p>_____________________________________________</p>
    

                <p>EVERTON LUIZ CANDIDO LUIZ</p>
                <p>Coordenador do Curso</p>
          
	




         
    </div>    
@stop



