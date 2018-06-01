<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
    {!! Charts::assets() !!}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}" style="margin-bottom: 0.5em;">
                        <img src="https://scontent.fauh1-1.fna.fbcdn.net/v/t1.0-9/19884087_166912523851010_9069674227465647267_n.png?oh=6a25a062cc7554ad975c8426deeb7fa2&oe=5A69312F" style="padding-bottom:10px; width:2em;" />
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse" style="padding-top:0.5em;">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                            <i class="fa fa-car" aria-hidden="true"></i> Voitures <span class="caret"></span>
                                        </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('voitures.index') }}" ><i class="fa fa-car" aria-hidden="true"></i> Toutes les Voitures</a></li>
                                    @if(Auth::user()->role_id < 3)
                                        <li><a href="{{ route('voitures.create') }}" ><i class="fa fa-plus" aria-hidden="true"></i> Créer Nouvelle Voiture </a></li>
                                    @if(Auth::user()->role_id  < 2)
                                        <li><a href="{{ route('voitures.index') }}" ><i class="fa fa-minus" aria-hidden="true"></i> Supprimer une Voiture</a></li>
                                    @endif
                                    @endif

                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                            <i class="fa fa-users" aria-hidden="true"></i> Clients <span class="caret"></span>
                                        </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('clients.index') }}"><i class="fa fa-users" aria-hidden="true"></i> Tous les Clients</a></li>
                                    <li><a href="{{ route('clients.index') }}"><i class="fa fa-plus" aria-hidden="true"></i> Créer Nouveau Client</a></li>
                                    <li><a href="{{ route('clients.index') }}"><i class="fa fa-minus" aria-hidden="true"></i> Tous les Clients</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Contrats <span class="caret"></span>
                                        </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('contrats.index') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Tous les Contrats</a></li>
                                    <li><a href="{{ route('contrats.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Créer Nouveau Contrat</a></li>
                                    <li><a href="{{ route('contrats.index') }}"><i class="fa fa-minus" aria-hidden="true"></i> Supprimer Nouveau Contrat</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                          <i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ Auth::user()->first_name . " " . Auth::user()->last_name  }} <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                            </li>
                        </ul>
                    @endguest
                </div>
            </div>
        </nav>
        @include('partials.success')
        @include('partials.errors')
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>

    </div>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="node_modules/chart.js/dist/Chart.js" type="text/javascript"></script>
    <script src="{{ asset('js/script.js') }}"></script> --}}

    <script src="https://use.fontawesome.com/8b3d88238a.js"></script>
</body>
</html>
