@extends('adminlte::coordinator')

@section('content_header')
    <h1>Fazer envio de certificados</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('coordinator.home') }}">Home</a></li>
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

            <form action="{{ route('coordinator.certificate.store') }}" method="post" enctype="multipart/form-data">
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
                
                <input id="idStudent" name="idStudent" type="hidden"> 

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