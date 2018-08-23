@extends('adminlte::page')

@section('content_header')
    <h1>Cadastrar novo coordenador de curso</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.activity.new') }}">Novo curso</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            <form action="{{ route('admin.coordinator.store') }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="course_id">Irá coordenar o curso:</label>
                    <select name="course_id" class="form-control">
                        <option value="">--- Selecione o curso ---</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" placeholder="Nome do coordenador" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" placeholder="CPF" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="telefones">Telefones para contato:</label>
                    <input type="text" name="telefones" placeholder="Ex.:  (XX) 9 XXXX-XXXX" class="form-control">
                </div>

                <div class="form-group">
                    <label for="registration">Matrícula SIAPE</label>
                    <input type="text" name="registration" placeholder="Ex.:  1234567" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail para logar no sistema:</label>
                    <input type="email" name="email" placeholder="fulanodetal@google.com" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>            
            </form>        
        </div>
    </div>
@stop