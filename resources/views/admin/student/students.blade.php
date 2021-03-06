@extends('adminlte::page')

@section('content_header')
    <h1>Alunos</h1>
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
                    <th>Matriculado no curso</th>
                    <th>Celular</th>
                    <th>Registro no IFRO</th>
                </tr>
            </thead>
            <tbody>        
                @forelse ($students as $student)
                    @if (!is_null($student->person))    
                        <tr>
                            <td>{{ $student->person->id }}</td>
                            <td>{{ $student->person->name}}</td>
                            <td>{{ $student->person->course->name}}</td>
                            <td>{{ $student->person->telefones }}</td>
                            <td>{{ $student->registration }}</td>
                        </tr>
                    @endif
                @empty
                @endforelse
                
            </tbody>
        </table>    
    </div>
    
@stop