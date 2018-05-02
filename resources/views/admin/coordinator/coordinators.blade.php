@extends('adminlte::page')

@section('content_header')
    <h1>Coordenadores</h1>
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
                    <th>Nome do coordenador</th>
                    <th>Coordena o curso</th>
                    <th>Celular</th>
                    <th>Registro no IFRO</th>
                </tr>
            </thead>
            <tbody>        
                @forelse ($coordinators as $coordinator)
                <tr>
                    <td>{{ $coordinator->person->id }}</td>
                    <td>{{ $coordinator->person->name}}</td>
                    <td>{{ $coordinator->course->name}}</td>
                    <td>{{ $coordinator->person->cel }}</td>
                    <td>{{ $coordinator->registration }}</td>
                </tr>
                @empty
                @endforelse
                
            </tbody>
        </table>    
    </div>
    
@stop