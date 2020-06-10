@extends('layouts.app')

@section('title', 'Help — ' . config('app.name', 'Laravel') . ' — Space for your message')

@section('meta_tags')
<meta name="title" content="{{ 'Help — ' . config('app.name', 'Laravel') . ' — Space for your message' }}">
<meta name="description" content="You want something, help yourself. © 2019 Moondepth. All rights reserved. Made by kara_sick">
<meta name="author" content="Kara Sick">
<meta name="keywords" content="moondepth,imageboard,forum,messenger,help,space,kara_sick,2019">
<meta name="robots" content="index,follow">
<meta property="og:title" content="{{ 'Help — ' . config('app.name', 'Laravel') . ' — Space for your message' }}" />
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
<div id="back-button" class="container white-text">
    <a class="waves-effect waves-light grey darken-3 btn-large" href="{{ route('welcome.index') }}">
        <strong>RETURN TO THE HOME</strong>
    </a>
</div>
<div class="container center">
    <h1><strong>Help</strong></h1>
</div>
<div class="container">
    <h3 class="justify-text"><u>{{ config('app.name', 'Laravel') . ' — Few tips to use'}}</u></h3>
    <ul type="disc">
        <li>
            <p class="justify-text flow-text">You want something, help yourself.</p>
        </li>
    </ul>
</div>
@endsection
