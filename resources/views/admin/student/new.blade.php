@extends('adminlte::page')

@section('content_header')
    <h1>Cadastrar novo Aluno</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.activity.new') }}">Novo Aluno</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            <form action="{{ route('admin.student.store') }}" method="post">
                {!! csrf_field() !!}

                <input id="course_id" name="course_id" type="hidden" value="{{ $course }}">

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" placeholder="Nome do aluno" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" placeholder="CPF" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="telefones">Telefones para contato:</label>
                    <input type="text" name="telefones" placeholder="Ex.:   Pessoal: (XX) 9 XXXX-XXXX;    Mãe (XX) 9 XXXX-XXXX;    Emergência: (XX) 9 XXXX-XXXX " class="form-control">
                </div>

                <div class="form-group">
                    <label for="registration">Matrícula</label>
                    <input type="text" name="registration" placeholder="Ex.:  2018107066029-0" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="group">Turma</label>
                    <input type="text" name="group" placeholder="Ex.:  20181066301A" class="form-control" required>
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