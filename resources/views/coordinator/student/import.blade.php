@extends('adminlte::coordinator')

@section('content_header')
    <h1>Cadastrar Alunos por importação</h1>
    <ol class="breadcrumb">
        
    </ol>

@stop
@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Importar arquivo</h3>
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
            <form action="{{ route('coordinator.student.import') }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}

                <div class="form-group">
                    <input type="file" name="fileStudents" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            
            </form>
        </div>
    </div>



    @isset($students)
        <div class="box-body">
            <table class="table table-bordered table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>      

                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student[0] }}</td>
                            <td>{{ $student[1] }}</td>
                            <td>{{ $student[2] }}</td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>    
        </div>
    @endisset

    @isset($studentsInvalided)
        <div class="box-body">
            <h1>Alunos não importados por dados incompletos</h1>
            <table class="table table-bordered table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>        
                    @foreach ($studentsInvalided as $studentInvalided)
                        @if (filter_var($student[11], FILTER_VALIDATE_EMAIL))  <!--valida se é email -->
                            <tr>
                                <td>{{ $studentInvalided[0] }}</td>
                                <td>{{ $studentInvalided[5] }}</td>
                                <td>{{ $studentInvalided[11] }}</td>
                                <td>{{ md5($studentInvalided[5]) }}</td>
                            </tr>
                        @else
                            
                        @endif                       
                    @endforeach                    
                </tbody>
            </table>    
        </div>

    @endisset
@stop