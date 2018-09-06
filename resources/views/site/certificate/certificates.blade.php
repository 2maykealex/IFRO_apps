@extends('adminlte::user')

@section('content_header')
    <h1>Certificados pendentes de verificação</h1>
    <ol class="breadcrumb">
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
                                    <td style="width:400px;">{{ $certificate->description}}</td>       
                                    <td></td>       
                                    <td></td>       
                                    
                                    <td>{{ $certificate->chCertificate}}</td>

                                    <td style="width:100px;">

                                        <a href="{{ url('storage/certificates/'.$certificate->image) }}" target="_blank">
                                            <button class="btn btn-primary">
                                                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                                            </button>
                                        </a>   


                                        

                                        <a href="{{ route('site.certificate.upload', [$certificate->id]) }}">
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



