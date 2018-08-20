@extends('adminlte::coordinator')

@section('title')
    Perfil do Aluno
@stop

@section('content_header')
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
            $("body").delegate("#studentName", "change", function(data){

                //Pegando o valor do select
                var valor = $(this).val();

                window.location = "/coordinator/certificates/pending/"+valor
            });

            $("#myModal").hide();
        }); 

        function showReason(id) {
            var modal = document.getElementById("myModal");

            if (id == -1){
                modal.style.display = "none";
            } else{
                modal.style.display = "block";
                inputId.focus();
            }
        }
    </script>   
    
    <br>

    <div class="text-center">
        <img src="{{ url('storage/profile/'.$coordinator->person->user->image) }}" class="img-fluid img-circle" alt="Responsive image" height="180" width="180">
        <h1> {{ $coordinator->person->name }} </h1>
        <h4>{{ $coordinator->person->course->name }}</h4>
        
    </div>

@stop

@section('content')

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
        <span class="close" onclick="showReason(-1)">&times;</span>

            <div class="form-group">
                <div class="form-group">
                    <h3>Adicionar assinatura digitalizada</h3>                
                </div>

                <form action="{{ route('coordinator.sign.store') }}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="image">Selecione a imagem de sua assinatura digitalizada:</label>
                        <input type="file" name="image" class="form-control-file" required>
                    </div>

                    <input id="idCoord" name="idCoord" type="hidden" value="{{ $coordinator->id }}"> 

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </div>            
                </form>  

                @isset($coordinator->signature)
                    <div class="form-group">
                        <img src="{{ url('storage/signatures/'.$coordinator->signature) }}" class="img-fluid " alt="Responsive image">
                    </div>        
                @endisset    
                    
            </div>
        </div>
    </div> 

    <div class="text-center"    >

        <a href="{{ route('change.password','0') }}">
            <button class="btn btn-warning">Altere sua senha</button>
        </a>

        <button class="btn btn-primary" onclick="showReason(1)">Adicionar sua assinatura digitalizada</button>

    </div>

@stop