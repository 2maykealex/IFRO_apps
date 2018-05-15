@extends('adminlte::page')

@section('content_header')
    <h1>Certificados</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.courses') }}">Lista de certificados de {{ $person->name }}</a></li>
    </ol>
@stop

@section('content')
    <div class="box-body">
        @include('admin.includes.alerts')
          
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th>#</th>                    
                    <th>Descrição</th>
                    <th>Correpondente a atividade</th>
                    <th>CH</th>
                    <th>Certificado</th>
                </tr>
            </thead>
            <tbody>        
                @forelse ($certificates as $certificate)
                <tr>
                    <td>{{ $certificate->id }}</td>
                    <td>{{ $certificate->description}}</td>
                    <td>{{ $certificate->activity->descricao}}</td>
                    <td>{{ $certificate->chCertificate}}</td>
                 
                    <td>
                        <a href="{{ url('storage/certificates/'.$certificate->image) }}" target="_blank">
                            <img src="{{ url('storage/certificates/'.$certificate->image) }}" style="max-width: 50px;" >  
                        </a> 
                    </td>

                </tr>
                @empty
                @endforelse
                
            </tbody>
        </table>  


    </div>



    
@stop



