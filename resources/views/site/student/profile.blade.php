@extends('adminlte::page')

@section('content_header')
    <h1>PERFIL</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.courses') }}">Lista de Coordenadores</a></li>
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
                    <th>Coordena o curso</th>
                    <th>Celular</th>
                    <th>Registro no IFRO</th>
                </tr>
            </thead>
            <tbody>        
                <!-- @forelse ($students as $student)
                <tr>
                    <td>{{ $student->person->id }}</td>
                    <td>{{ $student->person->name}}</td>
                    <td>{{ $student->course->name}}</td>
                    <td>{{ $student->person->cel }}</td>
                    <td>{{ $student->registration }}</td>
                </tr>
                @empty
                @endforelse -->
                
            </tbody>
        </table>    
    </div>
    
@stop