@extends('adminlte::page')

@section('content_header')
    <h1>Certificados enviados</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.courses') }}">Lista de certificados de {{ $person->name }}</a></li>
    </ol>
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
                            <th>Descrição:</th>      
                            <th>Link Validação:</th>      
                            <th>Código:</th>      
                            <th>Imagem:</th>
                            <th>CH Válidas:</th>      
                        </tr>
                    </thead>

                    <tbody> 

                        @forelse ($certificates as $certificate)

                            @if ($certificate->activity_id == $key)
                                <tr>
                                    <td></td>
                                    <td>{{ $certificate->id }}</td>
                                    <td>{{ $certificate->description}}</td>       
                                    <td></td>       
                                    <td></td>       
                                    <td>
                                        <a href="{{ url('storage/certificates/'.$certificate->image) }}" target="_blank">
                                            <img src="{{ url('storage/certificates/'.$certificate->image) }}" style="max-width: 50px;" >  
                                        </a> 
                                    </td>
                                    <td>{{ $certificate->chCertificate}}</td>
                                </tr>

                                <?php 
                                    $soum = $soum + $certificate->chCertificate;
                                    $idActivity = $certificate->activity_id; 
                                ?>
                            @endif


                        @empty
                        @endforelse

                        <?php
                            $count = $count + 1;
                        ?>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>TOTAL DE HORAS</strong></td>
                            <td><strong> <?php echo $soum.' Horas'?> </strong></td>
                        </tr>

                    </tbody>
                </table>
                <br>
                <hr>
            @endforeach  
        </table>  
    </div>    
@stop



