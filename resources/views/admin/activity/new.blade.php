@extends('adminlte::page')

@section('content_header')
    <h1>Cadastrar uma atividade complementar</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.activity.new') }}">Nova atividade</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            <form action="{{ route('admin.activity.store') }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="descricao">Descrição da atividade complementar:</label>
                    <textarea rows="4" cols="50" name="descricao" placeholder="Descrição" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="ch_activity">Carga horária máxima por certificado:</label>
                    <input type="text" name="ch_activity" placeholder="CH Atividade" class="form-control">
                </div>

                <div class="form-group">
                    <label for="ch_item">Carga horária máxima dessa atividade:</label>
                    <input type="text" name="ch_item" placeholder="CH Máxima do item" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            
            
            
            </form>
        
        
        </div>
    
    
    
    </div>
@stop