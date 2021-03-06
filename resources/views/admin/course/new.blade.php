@extends('adminlte::page')

@section('content_header')
    <h1>Cadastrar um curso</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.activity.new') }}">Novo curso</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Cadastrar novo</h3>
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            <form action="{{ route('admin.course.store') }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="area_id">Área do curso:</label>
                    <select name="area_id" class="form-control" required>
                        <option value="">--- Selecione a área ---</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->descricao }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Nome do curso:</label>
                    <input type="text" name="name" placeholder="Nome do curso" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="qtSem">Quantidade de semestres:</label>
                    <input type="text" name="qtSem" placeholder="Quantidade de semestres" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="chCourse">Carga horária:</label>
                    <input type="text" name="chCourse" placeholder="Carga horária" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="modalidade">Modalidade:</label>
                    <input type="text" name="modalidade" placeholder="Modalidade" class="form-control">
                </div>

                <div class="form-group">
                    <label for="chCourse">Carga horária mínima para colação:</label>
                    <input type="text" name="chMin" placeholder="Carga horária mínima para colação" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>            
            
            </form>

        </div>
    
    </div>
@stop