@extends('adminlte::coordinator')

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

                @if ($student)
                    <input id="studentInvalid" name="studentInvalid" type="hidden" value="{{ $student->id }}">
                @endif

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" placeholder="Nome do aluno" class="form-control" required value="<?php if($student) {echo $student->name;} ?>"  <?php if(!$student) {echo 'autofocus';} ?>>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" placeholder="CPF" class="form-control" required value="<?php if($student) {echo $student->cpf;} ?>">
                </div>

                <div class="form-group">
                    <label for="telefones">Telefones para contato:</label>
                    <input type="text" name="telefones" placeholder="Ex.: (XX) 9 XXXX-XXXX " class="form-control" value="<?php if($student) {echo $student->telefones;} ?>">
                </div>

                <div class="form-group">
                    <label for="registration">Matrícula</label>
                    <input type="text" name="registration" placeholder="Ex.:  2018107066029-0" class="form-control" required value="<?php if($student) {echo $student->registration;} ?>">
                </div>

                <div class="form-group">
                    <label for="group">Turma</label>
                    <input type="text" name="group" placeholder="Ex.:  20181066301A" class="form-control" required value="<?php if($student) {echo $student->group;} ?>">
                </div>

                <div class="form-group">
                    <label for="email">E-mail para logar no sistema:</label>
                    <input type="email" name="email" placeholder="fulanodetal@google.com" class="form-control" required <?php if($student) {echo 'autofocus';} ?>>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            
            </form>
        
        </div>
    
    </div>
@stop