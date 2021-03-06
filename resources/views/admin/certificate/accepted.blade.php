@extends('adminlte::page')

@section('content_header')

    <h1>Certificados aprovados</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.courses') }}">Lista de certificados dos Alunos</a></li>
    </ol>

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    
    <script>
        $(document).ready(function(e) {

            $("body").delegate("#studentName", "change", function(data){

                //Pegando o valor do select
                var valor = $(this).val();               

                window.location = "/admin/certificates/accepted/"+valor
            });

        });
    </script>   

@stop

@section('content')

    <div class="row">
        <div class="col-md-12">        
            <div class="form-group">

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

@if ($id > 0)
    <div class="form-group">            
        <a href="{{ route('admin.certificates.report', [$id]) }}">
            <button class="btn btn-primary" id="btnReport" >Ver Relatório</button>
        </a>   
    </div> 
@endif  

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

                                    <td style="width:275px;">{{ $certificate->person->name }}</td>
                                    <td style="width:370px;">{{ $certificate->description}}</td> 
                                    <td>{{ $certificate->updated_at->format('d/m/Y')}}</td>         
                                    <td></td>       
                                    <td style="width:40px;"></td>    
                                    
                                    <td>{{ $certificate->chCertificate}}</td>
                                    <td>                                        
                                        <a href="{{ url('storage/certificates/'.$certificate->image) }}" target="_blank">
                                            <button class="btn btn-primary">Imagem</button>
                                        </a>    

                                        <a href="#">
                                            <button class="btn btn-default"><i class="fa fa-undo"></i></button>
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



