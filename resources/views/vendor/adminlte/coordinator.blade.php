@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url('/coordinator') }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url('/coordinator') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li>
                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                            @else
                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">

                    <?php 
                        $url = explode("/", URL::current());      //Pega a URL Atual(string) e a transforma em array
                    ?>

                    @if (url('/coordinator') == URL::current() )
                        <li class="active">
                    @else
                        <li class="">
                    @endif
                        <a href="{{ url('/coordinator') }}">
                            <i class="fa fa-fw fa-university "></i>
                            <span>Home</span>
                        </a>
                    </li>

                    @if (url('/coordinator/activities') == URL::current() )
                        <li class="active">
                    @else
                        <li class="">
                    @endif
                        <a href="{{ url('/coordinator/activities') }}">
                            <i class="fa fa-fw fa-list-ul "></i>
                            <span>Lista de atividades</span>
                        </a>
                    </li>

                    @if (in_array('import-students', $url)   or in_array('student-new', $url)  or in_array('students', $url)  or in_array('students-invalided', $url)  or in_array('student', $url) )
                        <li class="active treeview menu-open">
                    @else
                        <li class="treeview">
                    @endif

                        <a href="{{ url('/coordinator') }}">
                            <i class="fa fa-fw fa-user "></i>
                            <span>Alunos</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>

                        <ul class="treeview-menu">
                            @if (in_array('import-students', $url))
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/coordinator') }}/import-students">
                                    <i class="fa fa-fw fa-file "></i>
                                    <span>Importar de arquivo .CSV</span>
                                </a>
                            </li>

                            @if (in_array('student-new', $url) )
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/coordinator') }}/student-new">
                                    <i class="fa fa-fw fa-plus-circle "></i>
                                    <span>Incluir novo aluno</span>
                                </a>
                            </li>
                        
                            @if (in_array('students', $url) or in_array('student', $url)) 
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/coordinator') }}/students">
                                    <i class="fa fa-fw fa-list-ul "></i>
                                    <span>Gerenciar alunos</span>
                                            </a>
                                    </li>
                            @if (in_array('students-invalided', $url))
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/coordinator') }}/students-invalided">
                                    <i class="fa fa-fw fa-list-ul "></i>
                                    <span>Alunos não validados</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    @if ((in_array('certificate-upload', $url)) or (in_array('pending', $url)) or (in_array('accepted', $url)) or (in_array('rejected', $url)) )
                        <li class="active treeview menu-open">
                    @else
                        <li class="treeview">
                    @endif
                        <a href="{{ url('/coordinator') }}"  >
                            <i class="fa fa-fw fa-user "></i>
                            <span>Certificados</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    
                        <ul class="treeview-menu">

                            @if (in_array('certificate-upload', $url))
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/coordinator') }}/certificate-upload"
                                        >
                                <i class="fa fa-fw fa-plus-circle "></i>
                                <span>Incluir novo certificado</span>
                                        </a>
                            </li>

                            @if (in_array('pending', $url))
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/coordinator') }}/certificates/pending"
                                        >
                                <i class="fa fa-fw fa-list-ul "></i>
                                <span>Gerenciar certificados pendentes</span>
                                        </a>
                            </li>

                            @if (in_array('accepted', $url))
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/coordinator') }}/certificates/accepted"
                                        >
                                <i class="fa fa-fw fa-list-ul "></i>
                                <span>Gerenciar certificados aceitos</span>
                                        </a>
                            </li>

                            @if (in_array('rejected', $url))
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/coordinator') }}/certificates/rejected"
                                        >
                                <i class="fa fa-fw fa-list-ul "></i>
                                <span>Gerenciar certificados recusados</span>
                                    </a>
                            </li>
                        </ul>
                    </li>

                    @if (in_array('report', $url))
                        <li class="active treeview menu-open">
                    @else
                        <li class="treeview">
                    @endif
                        <a href="{{ url('/coordinator') }}">
                            <i class="fa fa-fw fa-graduation-cap "></i>
                            <span>Relatórios</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        
                        <ul class="treeview-menu">
                            @if (in_array('report', $url))
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/coordinator') }}/report/complete">
                                    <i class="fa fa-fw fa-list-ul "></i>
                                    <span>Alunos com C.H. completa</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
                    <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
