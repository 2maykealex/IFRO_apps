@extends('adminlte::user')

@section('title')
    Perfil do Aluno
@stop

@section('content_header')

    <br>

    <div class="text-center">
        <img src="{{ url('storage/profile/'.$student->person->user->image) }}" class="img-fluid img-circle" alt="Responsive image" height="160" width="150">        
        <h1> {{ $student->person->name }} </h1>
        <h4> {{ $student->person->course->name }}</h4>
        
    </div>
@stop

@section('content')
    
    <div class="text-center">
        <a href="{{ route('change.password','0') }}">
            <button class="btn btn-warning">Altere sua senha</button>            
        </a>
        <button class="btn btn-primary" id="btnImg" >Altere sua imagem</button>

    </div>
@stop