@extends('adminlte::page')

@section('content_header')
    <h1>Lista de atividades complementares</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.activities') }}">Lista de atividades</a></li>
    </ol>
@stop

@section('content')
    <!-- <h2>Listando as atividades complementares</h2> -->

    <div class="box-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descrição do item</th>
                    <th>CH Atividade</th>
                    <th>CH Total item</th>
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