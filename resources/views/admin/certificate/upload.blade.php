@extends('adminlte::page')

@section('content_header')
    <h1>Fazer envio de certificados</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.activity.new') }}">Nova atividade</a></li>
    </ol>

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    
    <script>
        $(document).ready(function(e) {

            $("#formulario").hide();             // carrega a página com o formulário de envio oculto

            $("body").delegate("#studentName", "change", function(data){
                //Pegando o valor do select
                var valor = $(this).val();
                
                $("#idStudent").val(valor);
                
                if ($("#studentName").val() == '') {
                    $("#formulario").hide();
                } else {
                    $("#formulario").show();
                };
            });
        });
    </script>   

@stop

@section('content')

    <div class="row">
        <div class="col-md-12">        
            <div class="form-group">

                <label for="studentName">
                    Incluir certificado para o Aluno:
                </label>
                
                <select name="studentName" class="form-control" id="studentName" >
                    <option value="">Selecionar o aluno:</option>

                    @foreach ($students as $student)                         
                        <option value="{{ $student->person->id }}"> {{ $student->person->name }}</option>                        
                    @endforeach  
                </select>
            </div>
        </div> 
    </div>

    <div class="box" id="formulario">
        <div class="box-header">
            <h3>Enviar certificado</h3>
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            <form action="{{ route('admin.certificate.store') }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}

                <div class="form-group">
                    <select name="activity_id" class="form-control" required>
                        <option value="">--- Selecione a atividade que corresponde o certificado ---</option>
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

                <input id="idStudent" name="idStudent" type="hidden"> <!-- 0 não validado -->

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