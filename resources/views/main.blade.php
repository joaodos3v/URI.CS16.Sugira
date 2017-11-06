<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Sugira!</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{ asset('/css/material-dashboard.css') }}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('/css/fonts_Roboto.css') }}" rel="stylesheet" />

    <!--   Core JS Files   -->
    <script src="{{ asset('/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/material.min.js') }}" type="text/javascript"></script>
    <!--  PerfectScrollbar Library -->
    <script src="{{ asset('/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('/js/bootstrap-notify.js') }}" type="text/javascript"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="{{ asset('/js/material-dashboard.js?v=1.2.0') }}" type="text/javascript"></script>
    <!-- SweetAlert JS -->
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script> 
</head>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="green" data-image="../assets/img/sidebar-1.jpg">
            <!--
                Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

                Tip 2: you can also add an image using data-image tag
            -->
            <div class="logo">
                <a href="#" class="simple-text">
                    Sugira!
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="{{ (Request::is('/') ? 'active' : '') }}">
                        <a href="{{ url('/') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="{{ (Request::is('*perfis') ? 'active' : '') }}">
                        <a href="{{ url('/perfis') }}">
                            <i class="material-icons">group</i>
                            <p>Perfis de Usuário</p>
                        </a>
                    </li>
                    <li class="{{ (Request::is('*prefeituras') ? 'active' : '') }}">
                        <a href="{{ url('/prefeituras') }}">
                            <i class="material-icons">location_city</i>
                            <p>Prefeituras</p>
                        </a>
                    </li>
                    <li class="{{ (Request::is('*generos') ? 'active' : '') }}">
                        <a href="{{ url('/generos') }}">
                            <i class="material-icons">remove_red_eye</i>
                            <p>Gêneros</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#" style="font-size: 30px"> @yield('title_page') </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                    <i class="material-icons">arrow_drop_down</i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href=" {{ route('register') }} "> <i class="material-icons">person_add</i> &nbsp; Novo Usuário</a>
                                    </li>
                                    <li>
                                        <a href="#"> <i class="material-icons">settings</i> &nbsp; Configurações</a>
                                    </li>
                                    <hr>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                                            <i class="material-icons">exit_to_app</i> 
                                            &nbsp; Sair
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content" style="overflow: hidden;">
                <div class="container-fluid">
                    
                    @yield('content')

                </div>
            </div>
        </div>
    </div>
</body>

</html>