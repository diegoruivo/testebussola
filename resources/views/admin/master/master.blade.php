<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $system->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/reset.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/boot.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/style.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/libs.css')) }}">

@hasSection('css')
    @yield('css')
@endif

<!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/cde8c0fee9.js" crossorigin="anonymous"></script>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="icon" type="image/png" href="{{ url('storage/' . $system->favico) }}"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

@php
    if (\Illuminate\Support\Facades\File::exists(public_path() . '/storage/' . \Illuminate\Support\Facades\Auth::user()->cover)) {
        $cover = \Illuminate\Support\Facades\Auth::user()->url_cover;
    }

    if (\Illuminate\Support\Facades\Auth::user()->name) { $user_name = \Illuminate\Support\Facades\Auth::user()->name; $user_email = \Illuminate\Support\Facades\Auth::user()->email; }

    if (\TesteBussola\System::orderBy('id', 'ASC')->limit('1')->first()->id) { $system_id = \TesteBussola\System::orderBy('id', 'ASC')->limit('1')->first()->id; }
@endphp


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="" class="nav-link">Home</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-gear"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ $cover }}" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    {{ $user_name }}
                                </h3>
                                <p class="text-sm">{{ $user_email }}</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>

                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">Alterar Senha</a>

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item dropdown-footer">Sair</a>
                </div>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin.home') }}" class="brand-link">
            <img src="{{ url('storage/' . $system->favico) }}" alt="" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ $system->title }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ $cover }}" class="img-circle elevation-2">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ $user_name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="{{ route('admin.home') }}" class="nav-link {{ isActive('admin.home') }}">
                            <i class="nav-icon fa fa-tachometer-alt"></i>
                            <p>Painel de Controle</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.groups.index') }}" class="nav-link {{ isActive('admin.groups') }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>Turmas</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ isActive('admin.users') }}">
                            <i class="nav-icon fa fa-user-graduate"></i>
                            <p>Inscrições</p>
                        </a>
                    </li>




                    <li class="nav-item has-treeview {{ isOpen('admin.system') }} {{ isOpen('admin.courses') }} {{ isOpen('admin.series') }} ">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-gear"></i>
                            <p>
                                Configurações
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('admin.system.edit', ['system' => $system_id]) }}" class="nav-link {{ isActive('admin.system') }}">
                                    <i class="fa fa-caret-right nav-icon"></i>
                                    <p>Sistema</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.users.team') }}" class="nav-link">
                                    <i class="fa fa-caret-right nav-icon"></i>
                                    <p>Usuários</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('admin.courses.index') }}" class="nav-link {{ isActive('admin.courses') }}">
                                    <i class="fa fa-caret-right nav-icon"></i>
                                    <p>Cursos</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.series.index') }}" class="nav-link {{ isActive('admin.series') }}">
                                    <i class="fa fa-caret-right nav-icon"></i>
                                    <p>Séries</p>
                                </a>
                            </li>


                        </ul>
                    </li>







                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-sign-out"></i>
                            <p>Sair</p>
                        </a>
                    </li>


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>


@yield('content')

<!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>{{ $system->title }}</strong>
        Todos os diretos reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0 beta
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{ url(mix('backend/assets/js/libs.js')) }}"></script>
<script src="{{ url(mix('backend/assets/js/libs_table.js')) }}"></script>
<script src="{{ url(mix('backend/assets/js/scripts_up.js')) }}"></script>
<script src="{{ url(mix('backend/assets/js/mask_money.js')) }}"></script>

@hasSection('js')
    @yield('js')
@endif

</body>
</html>