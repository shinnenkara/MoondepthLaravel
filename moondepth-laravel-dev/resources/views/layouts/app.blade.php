<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ URL::asset('css/materialize.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ URL::asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
</head>
<body class="bg-dark text-white">
    <div id="app">
        <header>
            <nav id="top-nav" class="grey darken-3">
                <div class="container">
                    <div class="nav-wrapper">
                        <div class="row">
                            <div class="col s12 m10 offset-m1">
                                <a id="nav-mobile-button" href="#" data-target="nav-mobile" class="top-nav sidenav-trigger full hide-on-large-only">
                                <i class="material-icons">menu</i></a>
                                <a id="logo-container" href="{{ route('welcome.index') }}" class="brand-logo">
                                    <img class="hide-on-small-only" src="{{ asset('img/svg/moondepth.white.logo.svg') }}" alt="moondepth logo">
                                    <span>{{ config('app.name', 'Laravel') }}</span>
                                </a>
                            </div>

                            {{-- <div class="hide-on-small-only" id="navbarSupportedContent">
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
                            </div> --}}
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

        <!-- Page Content -->
        <main>
            <div class="container white-text">
                @yield('content')
            </div>
        </main>
    </div>

    <footer id="afterword-banner" class="page-footer grey darken-3">
        <div class="container footer-links">
            <div class="row">
                    <div class="col l6 s12">
                    <h5 class="white-text">Creator Bio</h5>
                    <p class="grey-text text-lighten-4">I'm student working on this project like it's my full time job.</p>
                </div>
                <div class="col l3 s12">
                    <h5 class="white-text">Connect</h5>
                    <ul><li><a class="white-text" href="#!">Some link too</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container footer-copyright">
            <span>© 2019 Moondepth. All rights reserved.</span>
            <span>Made by <a class="grey-text grey-lighten-3" href="https://t.me/kara_sick">kara_sick</a></span>
        </div>
    </footer>
</body>
</html>
