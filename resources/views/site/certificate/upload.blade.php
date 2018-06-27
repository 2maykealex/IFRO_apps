@extends('adminlte::user')

@section('content_header')
    <h1>Cadastrar novo certificado</h1>
    <ol class="breadcrumb">
        
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            <form action="{{ route('site.certificate.store') }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="activity_id">O certificado é relacionado com a atividade:</label>
                    <select name="activity_id" class="form-control" required>
                        <option value="">--- Selecione a atividade ---</option>
                        @foreach ($activities as $activity)
                            <option value="{{ $activity->id }}">{{ $activity->id }} - {{ $activity->descricao }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Descrição do certificado</label>
                    <input type="text" name="description" placeholder="Ex.: Curso de lógica" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="local">O certificado foi emitido em:</label>
                    <input type="text" name="local" placeholder="Local, Cidade e Estado onde foi emitido o certificado, mesmo que o curso foi à distância. Ex. Porto Velho - RO" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="period">Período que o curso estava envolvido:</label>
                    <input type="text" name="period" placeholder="Ex: Janeiro/2018;  Maio/2018 a Junho/2018" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="image">Selecione a imagem do certificado no seu computador:</label>
                    <input type="file" name="image" class="form-control-file" required>
                </div>

                <div class="form-group">
                    <label for="chCertificate">Carga horária registrada no certificado:</label>
                    <input type="number" name="chCertificate" placeholder="Ex.: 80" class="form-control" required>
                </div>

                <input id="prodId" name="certificateValided" type="hidden" value="0"> <!-- 0 não validado -->

                <div class="form-group">
                    <label for="linkValidation">Se houver um link de validação on-line, coloque aqui:</label>
                    <input type="text" name="linkValidation" placeholder="Ex.: https://academy.especializati.com.br/verificar-certificado" class="form-control">
                </div>

                <div class="form-group">
                    <label for="validationCode">Se houver código de validação para o certificado, coloque aqui:</label>
                    <input type="text" name="validationCode" placeholder="Ex.: 2tSTCXBFyq" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>            
            </form>        
        </div>    
    </div>
@stop