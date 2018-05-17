@extends('adminlte::page')

@section('content_header')
    <h1>Cadastrar um Aluno</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.activity.new') }}">Novo Aluno</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Cadastrar novo</h3>
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            <form action="{{ route('admin.student.store') }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <select name="course_id" class="form-control">
                        <option value="">--- Selecione o curso ---</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" name="name" placeholder="Nome do aluno" class="form-control">
                </div>

                <div class="form-group">
                    <input type="text" name="chCourse" placeholder="CPF" class="form-control">
                </div>

                <div class="form-group">
                    <input type="text" name="modalidade" placeholder="Matrícula" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            
            
            
            </form>
        
        
        </div>
    
    
    
    </div>
@stop