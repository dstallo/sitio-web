@extends('vendor.adminlte.master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    
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
            
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Navegación</span>
                </a>
            
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <?php /*
                        <li>
                            
                            <a href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                                <i class="fa fa-fw fa-power-off"></i> Cerrar sesión
                            </a>
                            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'logout')) }}" method="POST" style="display: none;">
                                @if(config('adminlte.logout_method'))
                                    {{ method_field(config('adminlte.logout_method')) }}
                                @endif
                                {{ csrf_field() }}
                            </form>
                            
                        </li>
                        */ ?>

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ Auth::user()->tnPerfil() }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->nombre }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{ Auth::user()->tnPerfil() }}" class="img-circle">

                                    <p>
                                        {{ Auth::user()->nombre }}
                                        <small>Miembro desde {{ date('d/m/Y', strtotime(Auth::user()->created_at)) }}</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <?php /* <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li> */ ?>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('editar_administrador', ['administrador' => Auth::user()]) }}" class="btn btn-default btn-flat">Editar cuenta</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
                                        <form id="logout-form" action="{{ route('admin-logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
                <!-- MENÚ PRINCIPAL -->
                <ul class="sidebar-menu nav" data-widget="tree">
                    <li>
                        <a href="{{ url('admin/') }}">
                            <i class="fa fa-fw fa-tachometer"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li><a href="{{ url('admin/consultas') }}">
                        <i class="fa fa-comments"></i>
                        <span>
                            Consultas
                            @if($sin_ver = App\Models\Consulta::where('vista', false)->count())
                                <span class="badge" style="margin-left:3px; margin-top:-3px">{{ $sin_ver }}</span>
                            @endif
                        </span>
                    </a></li>
                    <li><a href="{{ url('admin/newsletter/inscriptos') }}"><i class="fa fa-fw fa-envelope"></i><span>Newsletter</span></a></li>
                    <li><a href="{{ url('admin/encuestas') }}"><i class="fa fa-fw fa-check-square-o"></i><span>Encuestas satisfacción</span></a></li>
                    <li class="header">CONTENIDO</li>
                    <li><a href="{{ url('admin/paginas') }}"><i class="fa fa-file-text-o"></i><span>Páginas</span></a></li>
                    <li><a href="{{ url('admin/servicios') }}"><i class="fa fa-handshake-o"></i><span>Servicios</span></a></li>
                    <li><a href="{{ url('admin/novedades') }}"><i class="fa fa-newspaper-o"></i><span>Novedades</span></a></li>
                    <li><a href="{{ url('admin/publicaciones') }}"><i class="fa fa-bullhorn"></i><span>Publicaciones</span></a></li>
                    <li class="header">PERSONALIZACIÓN</li>
                    <li><a href="{{ url('admin/textos') }}"><i class="fa fa-font"></i><span>Textos Generales</span></a></li>
                    <li><a href="{{ url('admin/equipos') }}"><i class="fa fa-users"></i><span>Equipos</span></a></li>
                    <li><a href="{{ url('admin/iconos') }}"><i class="fa fa-address-book"></i><span>Socios</span></a></li>
                    <li><a href="{{ url('admin/centros') }}"><i class="fa fa-map-marker"></i><span>Sucursales</span></a></li>
                    <li><a href="{{ url('admin/agenda') }}"><i class="fa fa-calendar"></i><span>Agenda</span></a></li>
                    <li class="header">MULTIMEDIA</li>
                    <li><a href="{{ url('admin/slides') }}"><i class="fa fa-image"></i><span>Slides</span></a></li>
                    <li><a href="{{ route('contenidos') }}"><i class="fa fa-camera"></i><span>Nuestro Lugar</span></a></li>
                    <li><a href="{{ url('admin/popups') }}"><i class="fa fa-fw fa-window-maximize"></i><span>Popups home</span></a></li>
                    
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

        @include('admin.layout.configuracion')

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
