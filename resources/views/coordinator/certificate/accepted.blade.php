@extends('adminlte::coordinator')

@section('content_header')

    <h1>Certificados aprovados</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('coordinator.home') }}">Home</a></li>
        <li><a href="{{ route('coordinator.courses') }}">Lista de certificados dos Alunos</a></li>
    </ol>

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="{{ url('/vendor/jquery/jquery.min.js') }}"></script>
    
    <script>
        $(document).ready(function(e) {
            $("body").delegate("#group", "change", function(data){

                //Pegando o valor do select
                var group = $(this).val();
                
                route = "{{ url('/coordinator/certificates/accepted') }}"+"/"+group;
                
                window.location = route;
            });

            $("body").delegate("#studentName", "change", function(data){

                //pegando o id do Select Group
                var group = $("#group").val();
                // alert(group);

                //Pegando o valor do select
                var id = $(this).val();

                window.location = "/coordinator/certificates/accepted/"+group+"/"+id ;
            });

            // alert($("#group").val());

            if ($("#group").val() == 0){
                $("#studentBlock").hide();
            }else{
                $("#studentBlock").show();
            }
            
            $("#myModal").hide();
        });

    </script>   

@stop

@section('content')

    <div class="row">
        <div class="col-md-12">        
            <div class="form-group">

                <label for="group">
                    Filtrar alunos por turma:
                </label>

                <select name="group" id="group" class="form-control">
                    <option value="">Listar todos as turmas</option>

                    @foreach ($groups as $gp)          
                        <option value="{{ $gp->group }}" <?php if ($group == $gp->group) { echo "selected";  }?> > {{ $gp->group }}</option>                                                
                    @endforeach  
                </select>
                    <br>

                <div id="studentBlock">
                    <label for="studentName">
                        Filtrar certificados do Aluno:
                    </label>
                    
                    <select name="studentName" class="form-control" id="studentName" >
                        <option value="">Listar todos</option>

                        @foreach ($students as $student)          
                            @if (!is_null($student->person)) 
                                <option value="{{ $student->person->id }}" <?php if ($id == $student->person->id) { echo "selected";  }?> > {{ $student->person->name }}</option>                        
                            @endif                                    
                        @endforeach  
                    </select>
                </div>
            </div>
        </div> 
    </div>

@include('admin.includes.alerts')
    <div class="box-body">
          
        <table class="table table-bordered table-hover table-responsive">
            <!-- Sem Tag de cabeçalho -->

            @Foreach ($activities as $key => $activity)
                
                <?php $soum = 0; ?>

                <tbody>      
                    <tr>
                        <td><h4><strong>{{ $key.' - '.$activity}}</strong></h4></td>       
                    </tr>                    
                </tbody>
                
                <table class="table table-bordered table-hover table-responsive">
                    <thead>
                        <tr>                                
                            <th></th>
                            <th>#</th>           
                            <th>Aluno:</th>     
                            <th>Curso:</th>      
                            <th>Validado em:</th>      
                            <th>Link:</th>      
                            <th>Código:</th>    
                            <th>CH:</th>      
                            <th>Ações:</th>      
                        </tr>
                    </thead>

                    <tbody> 

                        <?php
                            $count = 1;
                        ?>

                        @forelse ($certificates as $certificate)

                            @if ($certificate->activity_id == $key)
                                <tr>
                                    <td></td>
                                    <td>{{ $count }}</td>

                                    <td style="width:275px;">{{ $certificate->name }}</td>
                                    <td style="width:370px;">{{ $certificate->description}}</td> 
                                    <td>{{ $certificate->updated_at}}</td>         
                                    <td></td>       
                                    <td style="width:40px;"></td>    
                                    
                                    <td>{{ $certificate->chCertificate}}</td>
                                    <td>                                        
                                        <a href="{{ url('storage/certificates/'.$certificate->image) }}" target="_blank">
                                            <button class="btn btn-primary">
                                                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                                            </button>
                                        </a>    


                                        <!-- <a href="#">
                                            <button class="btn btn-default"><i class="fa fa-undo"></i></button>
                                        </a>                                 -->
                                    </td>
                                </tr>

                                <?php 
                                    $count = $count + 1;
                                    $soum = $soum + $certificate->chCertificate;
                                    $idActivity = $certificate->activity_id; 
                                ?>
                            @endif

                        @empty
                        @endforelse
                        
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>TOTAL</strong></td>
                            
                            <td><strong> <?php echo $soum?> </strong></td>
                            <td><strong>HORAS</strong></td>
                            
                        </tr>
                    </tbody>
                </table>
                <br>
                <hr>
            @endforeach  
        </table>  
    </div>    
@stop



