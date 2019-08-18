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
<div class="center">

</div>
@endsection
