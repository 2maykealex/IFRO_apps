@extends('adminlte::page')

@section('content_header')
    <h1>Fazer upload de certificados</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.activity.new') }}">Nova atividade</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Cadastrar nova</h3>
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            <form action="{{ route('admin.certificate.store') }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}

                <div class="form-group">
                    <select name="activity_id" class="form-control" required>
                        <option value="">--- Selecione a atividade ---</option>
                        @foreach ($activities as $activity)
                            <option value="{{ $activity->id }}">{{ $activity->id }} - {{ $activity->descricao }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" name="description" placeholder="Descrição do certificado" class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="text" name="chCertificate" placeholder="CH do certificado" class="form-control" required>
                </div>

                <input id="prodId" name="chCertificateValided" type="hidden" value="0"> <!-- 0 não validado -->

                <div class="form-group">
                    <input type="file" name="image" class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="text" name="linkValidation" placeholder="Link da validação do certificado (opcional)" class="form-control">
                </div>

                <div class="form-group">
                    <input type="text" name="validationCode" placeholder="Código de validação do certificado (opcional)" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            
            </form>
        
        </div>
    
    </div>
@stop