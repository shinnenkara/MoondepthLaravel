@extends('layouts.app')

@section('title', config('app.name', 'Laravel') . ' — Space for your message')

@section('meta_tags')
<meta name="title" content="{{ config('app.name', 'Laravel') . ' — Space for your message' }}">
<meta name="description" content="Moondepth is a new image-based space where anyone can post comments with images. © 2019 Moondepth. All rights reserved. Made by kara_sick">
<meta name="author" content="Kara Sick">
<meta name="keywords" content="moondepth,imageboard,forum,messenger,welcome,space,index,kara_sick,2019">
<meta name="robots" content="index,follow">
<meta property="og:title" content="{{ config('app.name', 'Laravel') . ' — Space for your message' }}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="//moondepth.space/img/png/moondepth.dark.logo.png" />
<meta property="og:image:secure_url" content="{{ asset('img/png/moondepth.dark.logo.png') }}" />
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="300" />
<meta property="og:image:height" content="300" />
<meta property="og:url" content="{{ route('welcome.index') }}" />
<meta property="og:description" content="Moondepth is a new image-based space where anyone can post comments with images. © 2019 Moondepth. All rights reserved. Made by kara_sick" />
<meta property="og:site_name" content="Moondepth" />
@endsection

@section('content')
<div class="container center">
    <h1><strong>Welcome fellow man</strong></h1>
</div>

<div class="center">
    <div class="row">
        <form action="{{ route('search.index') }}" method="POST">
            @csrf
            <div class="input-field col s12">
                <input class="white-text" id="search" type="text" name="search" >
                <label for="first_name">Search</label>
                @error('search')
                <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
        </form>
        <div class="col s12 m6 l4">
            <h2><i>Big Board:</i></h2><br/>
            <a href="{{ route('board.show', ['board' => $big_board->headline]) }}" class="text-primary">/{{ $big_board->headline }}/ - {{ $big_board->description }}</a>
        </div>
        <div class="col s12 m6 l4">
            <h2><i>Best board:</i></h2><br/>
            <a href="{{ route('board.show', ['board' => $best_board->headline]) }}" class="text-primary">/{{ $best_board->headline }}/ - {{ $best_board->description }}</a>
        </div>
        <div class="col s12 m12 l4">
            <h2><i>Your board:</i></h2><br/>
            <a href="{{ route('board.show', ['board' => $random_board->headline]) }}" class="text-primary">/{{ $random_board->headline }}/ - {{ $random_board->description }}</a>
        </div>
    </div>
</div>
<br /><br /><br />
<div class="center hide-on-med-and-up">
    <div class="row">
        <div class="col s12 m6 l4">
            <h5><i><a href="{{ route('about.index') }}" class="text-primary">About</a></i></h5><br/>
        </div>
        <div class="col s12 m6 l4">
            <h5><i><a href="{{ route('help.index') }}" class="text-primary">Help</a></i></h5><br/>
        </div>
        <div class="col s12 m12 l4">
            <h5><i><a href="{{ route('help.index') }}" class="text-primary">Rules</a></i></h5><br/>
        </div>
    </div>
</div>
@endsection
