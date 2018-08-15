@extends('adminlte::page')

@section('title')
    Adm
@stop

@section('content_header')
    
    <br>

    <div class="text-center">
        <img src="{{ url('storage/profile/'.$user->image) }}" class="img-fluid img-circle" alt="Responsive image" height="160" width="150">
        <h1> {{ $user->name }} </h1>

        
    </div>
@stop

@section('content')

    <div class="row text-center">

        @include('admin.includes.alerts')
        <div>

            <a href="{{ route('change.password','0') }}">
                <button class="btn btn-warning">Altere sua senha</button>
            </a>

        </div>
        
    </div>
@stop