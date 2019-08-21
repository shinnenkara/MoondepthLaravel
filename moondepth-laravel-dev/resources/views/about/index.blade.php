@extends('layouts.app')

@section('title', 'About — ' . config('app.name', 'Laravel') . ' — Space for your message')

@section('meta_tags')
<meta name="description" content="Moondepth is a new image-based space where anyone can post comments with images. There are some specific boards on various topics you like. You don't need to register an account before posting any staff here.">
@endsection

@section('content')
<div id="back-button" class="container white-text">
    <a class="waves-effect waves-light grey darken-3 btn-large" href="{{ route('welcome.index') }}">
        <strong>RETURN TO THE HOME</strong>
    </a>
</div>
<div class="container center">
    <h1><strong>About</strong></h1>
</div>
<div class="container">
    <h3 class="justify-text-header"><u>{{ config('app.name', 'Laravel') . ' — Space for your message'}}</u></h3>
    <ul type="disc">
        <li>
            <p class="justify-text flow-text">Moondepth is a new image-based space where anyone can post comments with images. There are some specific boards on various topics you like.</span>
        </li>
        <li>
            <p class="justify-text flow-text">You don't need to register an account before posting any staff here.</span>
        </li>
        <li>
            <p class="justify-text flow-text">Check the <u><a href="{{ route('rules.index') }}" class="link text-primary">Rules</a></u> before posting. And you can message to mailbox@moondepth.space or read the <u><a href="{{ route('help.index') }}" class="link text-primary">Help</a></u> if something is unclear about Moondepth.</span>
        </li>
    </ul>
</div>
@endsection
