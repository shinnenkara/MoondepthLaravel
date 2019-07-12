<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ URL::asset('css/materialize.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div id="app">
        <header>
            <nav id="top-nav" class="grey darken-3">
                <div class="container">
                    <div class="nav-wrapper">
                        <div class="row">
                            <div class="col s8 m8 offset-m1">
                                <a href="#" data-target="nav-mobile" class="top-nav sidenav-trigger full hide-on-large-only" style="transform: translateX(0px);">
                                <i class="material-icons">menu</i></a>
                                <a id="logo-container" href="{{ route('welcome.index') }}" class="brand-logo" style="display: flex">
                                    <div><img src="{{ asset('img/svg/moondepth.white.logo.svg') }}" alt="moondepth logo" style="max-width:100%; max-height:100%;"></div>
                                    <div class="" style="font-size: 100%;">{{ config('app.name', 'Laravel') }}</div>
                                </a>
                            </div>

                            <div class="hide-on-small-only" id="navbarSupportedContent">

                                {{-- 
                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Log In') }}</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }} <span class="caret"></span>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Log Out') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
                                </ul> 
                                --}}
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <ul id="nav-mobile" class="sidenav sidenav-fixed">
                <ul class="section table-of-contents">
                    @foreach($boards as $board)
                    <li>
                        <a class = "white-text text-navbar" href="{{ route('board.show', $board->headline) }}" title="">/{{ $board->headline }}/ - {{ $board->description }}</a>
                    </li>
                    @endforeach
                </ul>
            </ul>
        </header>

        {{-- <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <div><img src="{{ asset('img/svg/moondepth.white.logo.svg') }}" alt="moondepth logo"></div>
                    <div class="" style="font-size: 125%">{{ config('app.name', 'Laravel') }}</div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <!-- Page Content -->
        <main>
            <div class="container white-text">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
