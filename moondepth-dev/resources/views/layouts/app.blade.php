<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: https://moondepth.space/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>@yield('title')</title>

    <!-- Metas -->
    @yield('meta_tags')

    <!-- Styles -->
    <link href="{{ URL::asset('css/materialize.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ URL::asset('js/app.js') }}" defer></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div id="app">
        <header>
            <nav id="top-nav" class="grey darken-3">
                <div class="container">
                    <nav class="nav-extended">
                        <div class="nav-wrapper">
                            <div class="row">
                                <div class="col s12 m8 offset-m1">
                                    <a id="nav-mobile-button" href="#" data-target="nav-mobile" class="top-nav sidenav-trigger full hide-on-large-only">
                                        <i class="material-icons">menu</i>
                                    </a>
                                    <a id="logo-container" href="{{ route('welcome.index') }}" class="brand-logo">
                                        <img class="hide-on-small-only" src="{{ asset('img/svg/moondepth.white.logo.svg') }}" alt="moondepth logo">
                                        <span id="app-name">{{ config('app.name', 'Laravel') }}</span>
                                    </a>
                                    @guest
                                        <a href="{{ route('login') }}" class="top-nav-text top-nav right hide-on-large-only hide-on-extra-large-only">
                                            {{--<span>Login</span>--}}
                                            <i class="material-icons">login</i>
                                        </a>
                                    @else
                                        <a href="#" class="top-nav-text top-nav right hide-on-large-only hide-on-extra-large-only">
                                            {{--<span>Profile</span>--}}
                                            <i class="material-icons">person</i>
                                        </a>
                                    @endguest
                                </div>
                                <div class="links additional-links hide-on-small-only hide-on-large-only hide-on-extra-large-only col m3">
                                    <!-- Dropdown Trigger -->
                                    <a class="dropdown-trigger" href="#info-dropdown" data-target="info-dropdown">
                                        <span>Info</span>
                                        <i class="material-icons right">arrow_drop_down</i>
                                    </a>
                                    <!-- Dropdown Structure -->
                                    <ul id='info-dropdown' class='dropdown-content'>
                                        <li><a id="about-link" href="{{ route('about.index') }}" class="additional-link text-primary">About</a></li>
                                        <li><a id="help-link" href="{{ route('help.index') }}" class="additional-link text-primary">Help</a></li>
                                        <li><a id="rules-link" href="{{ route('rules.index') }}" class="additional-link text-primary">Rules</a></li>
                                    </ul>
                                </div>
                                <div class="links additional-links hide-on-med-and-down col m5 l5 offset-l7">
                                    @guest
                                        <a id="rules-link" href="{{ route('login') }}" class="additional-link text-primary">Login</a>
                                    @else
                                        <a id="rules-link" class="additional-link text-primary"
                                           href="{{ route('user.show', ['username' => Auth::user()->username]) }}">Profile</a>
                                    @endguest
                                    <a id="about-link" href="{{ route('about.index') }}" class="additional-link text-primary">About</a>
                                    <a id="help-link" href="{{ route('help.index') }}" class="additional-link text-primary">Help</a>
                                    <a id="rules-link" href="{{ route('rules.index') }}" class="additional-link text-primary">Rules</a>
                                </div>
                            </div>
                        </div>
{{--                        <div class="nav-content hide-on-med-and-up">--}}
{{--                            <ul class="tabs tabs-transparent">--}}
{{--                                <li class="tab">--}}
{{--                                    <a id="about-link" href="{{ route('about.index') }}" class="additional-link text-primary">About</a>--}}
{{--                                </li>--}}
{{--                                <li class="tab">--}}
{{--                                    <a id="help-link" href="{{ route('help.index') }}" class="additional-link text-primary">Help</a>--}}
{{--                                </li>--}}
{{--                                <li class="tab">--}}
{{--                                    <a id="rules-link" href="{{ route('rules.index') }}" class="additional-link text-primary">Rules</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </nav>
                </div>
            </nav>
            <ul id="nav-mobile" class="sidenav sidenav-fixed">
                <ul class="section table-of-contents">
                    @foreach($boards as $board)
                    <li>
                        <a class = "white-text text-navbar" href="{{ route('board.show', $board->headline) }}" title="{{ $board->description }}">
                            <span>/{{ $board->headline }}/ - {{ $board->description }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </ul>
            <div class="fixed-action-btn">
                <button id="to-top-button" class="btn-floating btn-large grey darken-4">
                    <i class="large material-icons">arrow_drop_up</i></button>
            </div>
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
                    <ul>
                        <li class="hide-on-med-and-down"><a class="white-text" target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to=mailbox@moondepth.space&su=Moondepth%20User%20Report&body=<please write down your thoughts>">mailbox@moondepth.space</a></li>
                        <li class="hide-on-large-only"><a class="white-text" launch-external="true" href="mailto:mailbox@moondepth.space?subject=Moondepth User Report&body=<please write down your thoughts>">mailbox@moondepth.space</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container footer-copyright">
            <span>© 2019 Moondepth. All rights reserved.</span>
            <span>Made by <a class="grey-text grey-lighten-3" href="https://t.me/kara_sick">kara_sick</a></span>
        </div>
    </footer>

    <!-- Additional Plugins and JavaScript -->

    @stack('secondary-scripts')
</body>
</html>
