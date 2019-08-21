@extends('layouts.app')

@section('title', 'Help — ' . config('app.name', 'Laravel') . ' — Space for your message')

@section('meta_tags')
<meta name="description" content="">
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
            <p class="justify-text flow-text">You want something, help yourself.</span>
        </li>
    </ul>
</div>
@endsection
