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
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
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
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
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
                        
                        @if (url('/site') == URL::current() )
                            <li class="active">
                        @else
                            <li class="">
                        @endif
                            <a href="{{ url('/site') }}">
                                <i class="fa fa-fw fa-university "></i>
                                <span>Home</span>
                            </a>
                        </li>

                        @if ((url('/site/certificate-upload') == URL::current()) or (url('/site/certificates/pending') == URL::current()) or (url('/site/certificates/accepted') == URL::current())  or (url('/site/certificates/rejected') == URL::current())  )
                            <li class="active treeview menu-open">
                        @else
                            <li class="treeview">
                        @endif

                        <a href="{{ url('/coordinator') }}">
                            <i class="fa fa-fw fa-user "></i>
                            <span>Certificados</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>

                        <ul class="treeview-menu">                            

                            @if (url('/site/certificate-upload') == URL::current() )
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/site') }}/certificate-upload">
                                    <i class="fa fa-fw fa-plus-circle "></i>
                                    <span>Incluir novo certificado</span>
                                </a>
                            </li>
                        
                            @if (url('/site/certificates/pending') == URL::current() )
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/site') }}/certificates/pending">
                                    <i class="fa fa-fw fa-list-ul "></i>
                                    <span>Listar certificados pendentes</span>
                                </a>
                            </li>
                        
                            @if (url('/site/certificates/accepted') == URL::current() )
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/site') }}/certificates/accepted">
                                    <i class="fa fa-fw fa-list-ul "></i>
                                    <span>Listar certificados aceitos</span>
                                </a>
                            </li>
                        
                            @if (url('/site/certificates/rejected') == URL::current() )
                                <li class="active">
                            @else
                                <li class="">
                            @endif
                                <a href="{{ url('/site') }}/certificates/rejected">
                                    <i class="fa fa-fw fa-list-ul "></i>
                                    <span>Listar certificados recusados</span>
                                </a>
                            </li>
                        </ul>
                    </li>
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
