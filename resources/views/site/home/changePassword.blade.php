<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página inicial</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        /* html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        } */

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

    </style>

    

    <script type="text/javascript">
    
        function ToValidPassword(){ 
            
            password        = document.getElementById('password').value;
            confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password != confirmPassword){                
                alert("As senhas não conferem!");

                document.getElementById('password').value= "";
                document.getElementById('confirmPassword').value = "";
                
                document.getElementById('password').focus();
                return false;
            }
        }

    </script>

</head>
<body >
    <br>
    <br>

    @isset($user->reason)
        <br>
        <div class="alert alert-danger content" >
            <p style="color:red; font-weight: bold;">É obrigatório a alteração de sua senha no seu primeiro acesso ao sistema!</p>
        </div>
    @endisset

    <div class="content">
        <h1>Alteração de senha</h1>

        <p>Usuário logado: {{ $user->email }}</p>  

    </div>

    <div class="row">

        <div class="col-md-4">
        
        </div>

        <div class="col-md-4">
            <div class="box-body">        

                @include('admin.includes.alerts')
                <form action="{{ route('password.store') }}" method="post" class="form" name="formChangePassword">
                    {!! csrf_field() !!}

                    <input name="email" type="hidden" value="{{ $user->email }}">

                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" id="password" name="password" placeholder="Insira uma nova senha" class="form-control" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirmar senha:</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirme a senha digitada" onchange="ToValidPassword()" class="form-control"  required>
                    </div>
                    <br>
                    <div class="form-group">

                        @isset($user->reason)
                            <a href="{{ url('/logout') }}">
                                <button type="button" class="btn btn-warning">Sair</button>
                            </a>
                        @else
                            <a href="{{ URL::previous() }}">
                                <button type="button" class="btn btn-warning">Cancelar</button>
                            </a>
                        @endisset
                        
                        <button type="submit" class="btn btn-success">Salvar nova senha</button>
                    </div>            
                </form>
            </div>
        </div>

        <div class="col-md-4">
        
        </div>
    
    
    </div>
    

    
</body>
</html>
