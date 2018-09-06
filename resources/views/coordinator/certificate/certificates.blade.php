@extends('adminlte::coordinator')

@section('content_header')
    <h1>Certificados pendentes de verificação</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('coordinator.home') }}">Home</a></li>
        <li><a href="{{ route('coordinator.courses') }}">Lista de certificados dos Alunos</a></li>
    </ol>


    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="{{ url('/vendor/jquery/jquery.min.js') }}"></script>

    <style>            
            /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: none; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 50%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

    </style>
    
    <script>
        $(document).ready(function(e) {
            $("body").delegate("#group", "change", function(data){

                //Pegando o valor do select
                var group = $(this).val();
                
                route = "{{ url('/coordinator/certificates/pending') }}"+"/"+group;
                
                window.location = route;
            });

            $("body").delegate("#studentName", "change", function(data){

                //pegando o id do Select Group
                var group = $("#group").val();
                // alert(group);

                //Pegando o valor do select
                var id = $(this).val();

                window.location = "/coordinator/certificates/pending/"+group+"/"+id ;
            });
            
            @if ($id != 0)
                $("#studentBlock").show();
            @else

                if ($("#group").val() == 0){
                    $("#studentBlock").hide();
                }else{
                    $("#studentBlock").show();
                }
            
                $("#myModal").hide();
            @endif
        });

        function showReason(id) {
            var modal = document.getElementById("myModal");
            var inputId = document.getElementById("idCert");
            var form = document.getElementById("formCert");

            inputId.value = id;

            if (id == -1){
                modal.style.display = "none";
            } else{
                modal.style.display = "block";
                document.getElementById("reason").focus();
            }
        }
    </script>      
    
@stop

@section('content')

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
        <span class="close" onclick="showReason(-1)">&times;</span>
        
        <form action="{{ route('coordinator.certificate.reject') }}" method="POST">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="form-group">
                    <h3>Deseja recusar o certificado?</h3>                
                </div>
                
                <div class="form-group">
                    <label for="idCert">Informe o motivo:</label>
                    <input type="text" id="reason" name="reason" class="form-control" required focus> 

                    <input type="hidden" id="idCert" name="idCert"  > 
                    <input type="hidden" id="operation" name="operation" value = "2" > 
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">Recusar</button>
                    <a href="" class="btn btn-primary" onclick="showReason(-1)">Cancelar</a>    
                </div>                
                    
            </div>
        </form>
        </div>
    </div>         

    @if ($id == 0)
        <div class="row">
            <div class="col-md-12">        
                <div class="form-group">

                    <label for="group">
                        Filtrar alunos por turma:
                    </label>

                    <select name="group" id="group" class="form-control">
                        <option value="">Listar todas as turmas</option>

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
    @endif
    
    <div class="box-body">
        @include('admin.includes.alerts')
          
        <table class="table table-bordered table-hover table-responsive">
            <!-- Sem Tag de cabeçalho -->

            @Foreach ($activities as $key => $activity)
                
                <?php $soum = 0;?>

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
                                    <td style="width:270px;">{{ $certificate->name }}</td>
                                    <td style="width:300px;">{{ $certificate->description}}</td>   

                                    <td style="width:70px;">
                                        @if ($certificate->linkValidation != '')
                                            <a href="{{ $certificate->linkValidation }}" target="_blank">acessar</a>
                                        @endif
                                    </td>   

                                    <td> 
                                        @if ($certificate->validationCode != '')
                                            {{ $certificate->validationCode }}
                                        @endif
                                    </td>       
                                    
                                    <td>{{ $certificate->chCertificate}}</td>

                                    <td style="width:190px;">

                                        <a href="{{ url('storage/certificates/'.$certificate->image) }}" target="_blank">
                                            <button class="btn btn-primary">
                                                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                                            </button>
                                        </a>   
                                        
                                        
                                        <a href="{{ route('coordinator.certificate.validate', [$certificate->cId, 1]) }}">
                                            <button class="btn btn-success">
                                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                            </button>
                                        </a>

                                        <button class="btn btn-danger" id="reject_{{ $certificate->cId }}" onclick="showReason('{{ $certificate->cId }}')" >
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </button>

                                        <a href="{{ route('coordinator.certificate.upload', [$certificate->cId]) }}">
                                            <button class="btn btn-warning">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </button>
                                        </a>
                                        
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

    

