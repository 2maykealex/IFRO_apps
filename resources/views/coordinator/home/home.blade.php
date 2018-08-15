@extends('adminlte::coordinator')

@section('title')
    Perfil do Aluno
@stop

@section('content_header')
    
    <br>

    <div class="text-center">
        <img src="{{ url('storage/profile/'.$coordinator->person->user->image) }}" class="img-fluid img-circle" alt="Responsive image" height="180" width="180">
        <h1> {{ $coordinator->person->name }} </h1>
        <h4>{{ $coordinator->person->course->name }}</h4>
        
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
            </div>
        </div>

        @isset($coordinator->signature)
            <div class="form-group">
            <img src="{{ url('storage/signatures/'.$coordinator->signature) }}" class="img-fluid " alt="Responsive image">
            </div>        

        @endisset
    </div>
@stop