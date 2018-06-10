@extends('adminlte::page')

@section('content_header')

    <div class="row">
        <div class="col-md-10">
            <h1>Certificados aprovados</h1>    
            
        </div>

        <div class="col-md-2">
            <div class="row">
            <br>

            <a href="{{ route('admin.certificates.report') }}">
                <button class="btn btn-primary">Ver Relatório</button>
            </a>   
            
            </div>

                 
        </div>  
    </div>
    


@stop

@section('content')
    <div class="box-body">
        @include('admin.includes.alerts')
          
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
                            <th>Link Validação:</th>      
                            <th>Código:</th>    
                            <th>CH Válidas:</th>      
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
                                    <td style="width:280px;">{{ $certificate->person->name }}</td>
                                    <td style="width:400px;">{{ $certificate->description}}</td>       
                                    <td>{{ $certificate->updated_at->format('d/m/Y')}}</td>       
                                    <td></td>       
                                    <td></td>       
                                    
                                    <td>{{ $certificate->chCertificate}}</td>
                                    <td>
                                        
                                        <a href="{{ url('storage/certificates/'.$certificate->image) }}" target="_blank">
                                            <button class="btn btn-primary">Imagem</button>
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



