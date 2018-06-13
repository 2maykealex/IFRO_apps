@extends('adminlte::user')

@section('content_header')
    <h1>Fazer upload de certificados</h1>
    <ol class="breadcrumb">
        
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Cadastrar novo</h3>
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            <form action="{{ route('site.certificate.store') }}" method="post" enctype="multipart/form-data">
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
                    <input type="text" name="local" placeholder="Local, Cidade e Estado onde foi emitido o certificado" class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="text" name="period" placeholder="Ex: Janeiro/2018;  Maio/2018 a Junho/2018" class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="file" name="image" class="form-control" required>
                </div>

                <div class="form-group">
                    <input type="text" name="chCertificate" placeholder="CH do certificado" class="form-control" required>
                </div>

                <input id="prodId" name="certificateValided" type="hidden" value="0"> <!-- 0 não validado -->

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