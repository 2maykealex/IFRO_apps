@extends('adminlte::page')

@section('content_header')
    <h1>Cursos ofertados no IFRO <i>Campus</i> Zona Norte</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.courses') }}">Lista de cursos</a></li>
    </ol>
@stop

@section('content')
    <div class="box-body">
        @include('admin.includes.alerts')
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Curso</th>
                    <th>Qtd Semestres</th>
                    <th>CH Curso</th>
                    <th>Modalidade</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->name}}</td>
                    <td>{{ $course->qtSem }}</td>
                    <td>{{ $course->chCourse }}</td>
                    <td>{{ $course->modalidade }}</td>

                </tr>
                @empty
                @endforelse
            </tbody>
        </table>    
    </div>
    
@stop