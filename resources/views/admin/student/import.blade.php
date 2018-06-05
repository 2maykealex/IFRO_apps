@extends('adminlte::user')

@section('content_header')
    <h1>Cadastrar Alunos por importação</h1>
    <ol class="breadcrumb">
        
    </ol>
@stop
@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Importar arquivo</h3>
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            <form action="{{ route('student.import.store') }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}

                <div class="form-group">
                    <input type="file" name="fileStudents" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            
            </form>
        
        </div>
    
    </div>
@stop