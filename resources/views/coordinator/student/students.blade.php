@extends('adminlte::coordinator')

@section('content_header')
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="{{ url('/vendor/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function(e) {
            $("body").delegate("#group", "change", function(data){

                //Pegando o valor do select
                var valor = $(this).val();
                url = "{{ url('/coordinator/students') }}" + "/" + valor;
                // alert(url);
                
                window.location = url;
            });
        }); 
    </script>


    <h1>Alunos</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
        <li><a href="{{ route('admin.courses') }}">Lista de Alunos</a></li>
    </ol>
@stop

@section('content')
    <div class="box-body">

        <div class="form-group">

        <label for="group">
            Filtrar por Turma:
        </label>

        <select name="group" class="form-control" id="group" >
            <option value="">Listar todos os alunos</option>

            @foreach ($groups as $gp)          
                <option value="{{ $gp->group }}" <?php if ($group == $gp->group) { echo "selected";  }?> > {{ $gp->group }}</option>                                                
            @endforeach  
        </select>
        </div>

        @include('admin.includes.alerts')
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Matriculado no curso</th>
                    <th>Matrícula</th>
                    <th>Celular</th>                    
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>        
                @forelse ($students as $student)
                    @if (!is_null($student->person))    
                        <tr>
                            <td >
                                <img src="{{ url('/storage/profile/'.$student->person->user->image) }}" width="30px" class="img-fluid img-circle img-responsive">
                            </td>
                            <td>{{ $student->person->name}}</td>
                            <td>{{ $student->person->course->name}}</td>                            
                            <td>{{ $student->registration }}</td>
                            <td>{{ $student->person->telefones }}</td>
                            <td>{{ $student->person->user->email }}</td>
                            <td>
                                <a href="{{ route('coordinator.student.edit', compact('student')) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>                        
                        </td>
                        </tr>
                    @endif
                @empty
                @endforelse
                
            </tbody>
        </table>    
    </div>
    
@stop