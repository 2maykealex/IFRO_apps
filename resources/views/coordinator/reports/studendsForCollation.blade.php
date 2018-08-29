@extends('adminlte::coordinator')

@section('content_header')
    <h1>Alunos que já atingiram 100% da carga horária em atividades complementares</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('coordinator.home') }}">Home</a></li>
    </ol>
    
@stop

@section('content')
    
    <div class="box-body">
        @include('admin.includes.alerts')
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th>Turma</th>
                    <th>Nome</th>
                    <th>Matrícula</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                <tr>
                    <td>{{ $student->group }}</td>
                    <td>{{ $student->studentName}}</td>
                    <td>{{ $student->registration }}</td>                    
                    
                    <td  style="width:270px;">
                        <a href="{{ route('coordinator.report.attestation', [$student->id]) }}">
                            <button class="btn btn-success">Gerar relatório</button>
                        </a>
                        <a href="#">
                            <button class="btn btn-danger">Finalizar</button>
                        </a>
                    
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>    
    </div>
       
@stop



