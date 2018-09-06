@extends('adminlte::user')

@section('content_header')
    <h1>Cadastrar novo certificado</h1>
    <ol class="breadcrumb">
        
    </ol>

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

    <script src="{{ url('/vendor/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function(e) {

            @if (!isset($id))
                $("#formulario").hide();  // carrega a página com o formulário de envio oculto
                showImage();
            @else
                $("#imgCert").hide();  // carrega a página com o formulário de envio oculto
            @endif

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

        function showImage(){
            var htmlText;
            htmlText = "  <div class='form-group'>";
            htmlText =  htmlText + "<label for='image'>Selecione a imagem do certificado no seu computador:</label>";
            htmlText =  htmlText + "<input type='file' name='image' class='form-control-file' required > </div>";

            document.getElementById('imgCert').innerHTML = htmlText;
        }

        function btnClickedShowImage(){
            showImage();
            $("#imgCert").show();
        }
    </script>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            
            @isset($certificate)
                <form action="{{ route('site.certificate.update') }}" method="post" enctype="multipart/form-data">
            @else
                <form action="{{ route('site.certificate.store') }}" method="post" enctype="multipart/form-data">
            @endif

                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="activity_id">O certificado é relacionado com a atividade:</label>
                    <select name="activity_id" class="form-control" required>
                        <option value="">--- Selecione a atividade ---</option>
                        @foreach ($activities as $activity)
                            <option value="{{ $activity->id }}" <?php if (isset($certificate)) {if ($activity->id == $certificate->activity_id) {echo "Selected";}} ?>>{{ $activity->id }} - {{ $activity->descricao }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Descrição do certificado</label>
                    <input type="text" name="description" placeholder="Ex.: Curso de lógica" class="form-control" required <?php if (isset($certificate->description)) {echo "value = '$certificate->description'";} ?>>
                </div>
                
                <div class="form-group">
                    <label for="local">O certificado foi emitido em:</label>
                    <input type="text" name="local" placeholder="Local, Cidade e Estado onde foi emitido o certificado, mesmo que o curso foi à distância. Ex. Porto Velho - RO" class="form-control" required <?php if (isset($certificate->local)) {echo "value = '$certificate->local'";} ?>>
                </div>

                <div class="form-group">
                    <label for="period">Período que o curso estava envolvido:</label>
                    <input type="text" name="period" placeholder="Ex: Janeiro/2018;  Maio/2018 a Junho/2018" class="form-control" required <?php if (isset($certificate->period)) {echo "value = '$certificate->period'";} ?>>
                </div>

                <div class="form-inline">
                    
                    <div id="imgCert" class="form-group">

                    </div>

                    @isset($certificate)
                        <input id="update" name="update" type="hidden" value="1"> 
                        <input id="certId" name="certId" type="hidden" value="{{ $certificate->id }}"  > 

                        <div class="form-group">
                            <button type="button" id="btnImgCert" onclick="btnClickedShowImage();" class="btn btn-success">Alterar a imagem do Certificado?</button>
                        </div>
                        
                        <div class="form-group">
                            <a href="{{ url('storage/certificates/'.$certificate->image) }}" target="_blank">
                                <img src="{{ url('storage/certificates/'.$certificate->image) }}" class="img-fluid" alt="Responsive image" height="180" width="210"> 
                            </a>
                        </div>                    
                    @endif
                </div>
                <br>

                <div class="form-group">
                    <label for="chCertificate">Carga horária registrada no certificado:</label>
                    <input type="number" name="chCertificate" placeholder="Ex.: 80" class="form-control" required <?php if (isset($certificate->chCertificate)) {echo "value = $certificate->chCertificate";} ?>>
                </div>

                <input id="prodId" name="certificateValided" type="hidden" value="0"> <!-- 0 não validado -->

                <div class="form-group">
                    <label for="linkValidation">Se houver um link de validação on-line, coloque aqui:</label>
                    <input type="text" name="linkValidation" placeholder="Ex.: https://academy.especializati.com.br/verificar-certificado" class="form-control" <?php if (isset($certificate->linkValidation)) {echo "value = $certificate->linkValidation";} ?>>
                </div>

                <div class="form-group">
                    <label for="validationCode">Se houver código de validação para o certificado, coloque aqui:</label>
                    <input type="text" name="validationCode" placeholder="Ex.: 2tSTCXBFyq" class="form-control" <?php if (isset($certificate->validationCode)) {echo "value = $certificate->validationCode";} ?>>
                </div>

                @if (!isset($id))
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Salvar novo</button>
                    </div>      
                @else
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </div>                
                @endif             
            </form>        
        </div>    
    </div>
@stop