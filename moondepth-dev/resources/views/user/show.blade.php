@extends('layouts.app')

@section('title', 'Profile — ' . config('app.name', 'Laravel') . ' — Space for your message')

@section('meta_tags')
    <meta name="title" content="{{ 'Profile — ' . config('app.name', 'Laravel') . ' — Space for your message' }}">
    <meta name="description" content="You want something, help yourself. © 2019 Moondepth. All rights reserved. Made by kara_sick">
    <meta name="author" content="Kara Sick">
    <meta name="keywords" content="moondepth,imageboard,forum,messenger,help,space,kara_sick,2019">
    <meta name="robots" content="index,follow">
    <meta property="og:title" content="{{ 'Profile — ' . config('app.name', 'Laravel') . ' — Space for your message' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="//moondepth.space/img/png/moondepth.dark.logo.png" />
    <meta property="og:image:secure_url" content="{{ asset('img/png/moondepth.dark.logo.png') }}" />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    <meta property="og:url" content="{{ route('help.index') }}" />
    <meta property="og:description" content="You want something, help yourself. © 2019 Moondepth. All rights reserved. Made by kara_sick" />
    <meta property="og:site_name" content="Moondepth" />
@endsection

@section('content')
    <div class="row" style="margin-top: 2.8rem;">
        <div class="col l5 m4 s12 center-align">
            <div class="text-white">
                <div class="m-b-25">
                    <img class="responsive-img circle" style="max-height: 100px"
                         src="{{ asset('./img/jpg/anon-1-100.jpg') }}" alt="User-Profile-Image">
                </div>
                <h6 class="f-w-600">{{ $user->username }}</h6>
                <p>Anonymous</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
            </div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a class="grey-text grey-lighten-3" href="route('logout')"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
        <div class="col l7 m8 s12">
            <h6 class="">Information</h6>
            <div class="divider"></div>
            <div class="row">
                <div class="col s6">
                    <p class="">Email</p>
                    <h6 class="">{{ $user->email }}</h6>
                </div>
{{--                <div class="col s6">--}}
{{--                    <p class="">Phone</p>--}}
{{--                    <h6 class="">98979989898</h6>--}}
{{--                </div>--}}
            </div>
            <h6 class="">Thread Activity</h6>
            <div class="divider"></div>
            <div class="row">
                <div class="col s6">
                    <p class="">Recent</p>
                    <h6 class="">{{ 'No recent activity' }}</h6>
                </div>
                <div class="col s6">
                    <p class="">Most Viewed</p>
                    <h6 class="three">{{ 'No recent threads' }}</h6>
                </div>
            </div>
            @if($user->id == Auth::id())
                <h6 class="">WebAuthn Credentials</h6>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12">
                        @if(isset($credentials) && count($credentials) > 0)
                            <ul>
                                @foreach($credentials as $credential)
                                    <li>
                                        <h6 class="truncate">{{ $credential['id'] }}</h6>
                                    </li>
                                    <a class="waves-effect waves-light grey darken-3 btn-small"
                                       href="#!">
                                        <span class="truncate">Disable</span>
                                    </a>
                                    <a class="waves-effect waves-light grey darken-3 btn-small"
                                       href="#!">
                                        <span class="truncate">Delete</span>
                                    </a>
                                @endforeach
                            </ul>
                        @else
                            <h6 class="">There are no registered WebAuthn credentials at the moment</h6>
                        @endif
                    </div>
                    <div class="col s6" style="margin-block-start: 1em;">
                        <a class="waves-effect waves-light grey darken-3 btn"
                           href="{{ route('webauthn.register.form') }}">
                            <span class="truncate">Add Credential</span>
                        </a>
                    </div>
                </div>
                <h6 class="">Devices</h6>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12">
                        @if(isset($devices) && count($devices) > 0)
                            <ul>
                                @foreach($devices as $device)
                                    <li>
                                        <h6 class="truncate">{{ $device['device_type'] . " - IP: " . $device['ip'] }}</h6>
                                    </li>
                                    <a class="waves-effect waves-light grey darken-3 btn-small"
                                       href="#!">
                                        <span class="truncate">Delete</span>
                                    </a>
                                @endforeach
                            </ul>
                        @else
                            <h6 class="">There are no registered devices at the moment</h6>
                        @endif
                    </div>
                    <div class="col s6" style="margin-block-start: 1em;">
                        <a class="waves-effect waves-light grey darken-3 btn"
                           href="{{ '#!' }}">
                            <span class="truncate">Add Device</span>
                        </a>
                    </div>
                </div>
                <h6 class="">Settings</h6>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s6" style="margin-block-start: 1em;">
                        <a class="waves-effect waves-light grey darken-3 btn"
                           href="#!">
                            <span class="truncate">Change Password</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
