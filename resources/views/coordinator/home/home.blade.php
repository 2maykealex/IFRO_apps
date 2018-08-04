@extends('adminlte::coordinator')

@section('title')
    Perfil do Aluno
@stop

@section('content_header')
    
    <br>

    <div class="text-center">
        <img src="{{ url('storage/profile/1.jpg') }}" class="img-fluid img-circle" alt="Responsive image" height="160" width="150">
        <h1> MaykeAlexMirandaPlaça </h1>
        <h4>Curso Superior de Tecnologia em Redes</h4>
        
    </div>
@stop

@section('content')

    <div class="row">

        <div>

            <a href="{{ route('change.password','0') }}">
                <button class="btn btn-warning">Altere sua senha</button>
            </a>

        </div>

        <div class="col-md-6 box" id="formulario">

            <div class="box-body">
                @include('admin.includes.alerts')

                <form action="{{ route('coordinator.certificate.store') }}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="image">Selecione a imagem de sua assinatura digitalizada:</label>
                        <input type="file" name="image" class="form-control-file" required>
                    </div>

                    <input id="idCoord" name="idCoord" type="hidden"> 

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </div>            
                </form> 
                
            
            </div>
        
        </div>
    </div>
@stop