@extends('adminlte::coordinator')

@section('content_header')
    <h1>Alunos não importados do curso de {{ $courseName }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.courses') }}">Lista de Alunos</a></li>
    </ol>
@stop

@section('content')
    <div class="box-body">
        @include('admin.includes.alerts')
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>telefone</th>
                    <th>Matrícula</th>
                    <th>Turma</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>        
                @forelse ($students as $student)  
                    <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $student->name}}</td>
                        <td>{{ $student->telefones }}</td>
                        <td>{{ $student->registration }}</td>
                        <td>{{ $student->group }}</td>
                        <td>
                            <a href="{{ route('admin.student.new', compact('student')) }}">
                                <button class="btn btn-warning">Editar</button>
                            </a>                        
                        </td>
                    </tr>
                    <?php $count++; ?>

                @empty
                @endforelse
                
            </tbody>
        </table>    
    </div>
    
@stop