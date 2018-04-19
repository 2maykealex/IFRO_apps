@extends('adminlte::page')

@section('content_header')
    <h1>QUADRO DEMONSTRATIVO DE ATIVIDADES ACADÊMICAS COMPLEMENTARES PREVISTAS</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.activities') }}">Lista de atividades</a></li>
    </ol>
@stop

@section('content')
    <!-- <h2>Listando as atividades complementares</h2> -->

    <div class="box-body">
        @include('admin.includes.alerts')
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Atividades Acadêmicas complementares</th>
                    <th>CH Máxima por Atividade</th>
                    <th>CH Máxima por item</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activities as $activity)
                <tr>
                    <td>{{ $activity->id }}</td>
                    <td>{{ $activity->descricao}}</td>
                    <td>{{ $activity->CHAtividade }}</td>
                    <td>{{ $activity->CHItem }}</td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>    
    </div>
    
@stop