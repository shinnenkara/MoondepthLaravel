@extends('layouts.app')

@section('title', 'Search — ' . config('app.name', 'Laravel') . ' — Space for your message')

@section('meta_tags')
<meta name="title" content="{{ 'Search — ' . config('app.name', 'Laravel') . ' — Space for your message' }}">
<meta name="description" content="By using this website (the 'site'), you agree that you'll follow these rules, and understand that if we reasonably think you haven't followed these rules, we may (at our own discretion) terminate your access to the site:">
<meta name="author" content="Kara Sick">
<meta name="keywords" content="moondepth,imageboard,forum,messenger,rules,space,kara_sick,2019">
<meta name="robots" content="index,follow">
<meta property="og:title" content="{{ 'Search — ' . config('app.name', 'Laravel') . ' — Space for your message' }}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="//moondepth.space/img/png/moondepth.dark.logo.png" />
<meta property="og:image:secure_url" content="{{ asset('img/png/moondepth.dark.logo.png') }}" />
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="300" />
<meta property="og:image:height" content="300" />
<meta property="og:url" content="{{ route('search.index') }}" />
<meta property="og:description" content="By using this website (the 'site'), you agree that you'll follow these rules, and understand that if we reasonably think you haven't followed these rules, we may (at our own discretion) terminate your access to the site:" />
<meta property="og:site_name" content="Moondepth" />
@endsection

@section('content')
<div id="back-button" class="container white-text">
    <a class="waves-effect waves-light grey darken-3 btn-large" href="{{ route('welcome.index') }}">
        <strong>RETURN TO THE HOME</strong>
    </a>
</div>
<div class="container center">
    <h1><strong>Here your result:</strong></h1>
</div>
@if(count($threads) < 1)
    <p class="justify-text flow-text">No result founded</p>
@else
<div id="board-threads" class="">
    <div class="row">
        @foreach($threads as $thread)
            <div class="thread col l12 m12 s12">
                <div class="thread-topic">
                    <div class="thread-head">
                        <i class="material-icons hidethread-icons content">arrow_drop_down</i>
                        <a class="white-text" href="{{ route('thread.show', ['board' => $thread->board->headline, 'thread' => $thread->id]) }}">
                            <h5 class="content"><strong>{{ $thread->topic }}</strong></h5>
                            <h5 class="content grey-text text-lighten-1">{{ mb_strtoupper(mb_substr($thread->user->username, 0, 1)).mb_substr($thread->user->username, 1) }}</h5>
                            <h5 class="content">{{ $thread->created_at }}</h5>
                            <h5 class="content">No. {{ $thread->id }}</h5>
                        </a>
                        <h5 class="content">
                            [<a class="white-text" href="{{ route('thread.show', ['board' => $thread->board->headline, 'thread' => $thread->id]) }}">
                                <span class="grey-text text-lighten-1">Reply</span>
                            </a>]
                        </h5>
                    </div>
                    <div class="thread-body">
                        @if(!$thread->files->isEmpty())
                            <div class="thread-files">
                                <div class="row">
                                    @foreach($thread->files as $file)
                                        <thread-image src="{{ Storage::disk('s3')->url($file->s3_path) }}" alt="{{ urldecode($file->original_name) }}" size="{{$file->size}}" width="{{$file->width}}" height="{{$file->height}}"></thread-image>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="container">
                            <div class="message-text">
                                <h5>{!! nl2br(e($thread->subject_text)) !!}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="thread-messages">
                    <div class="row">
                        @foreach($thread->messages()->latest()->limit(3)->get()->reverse() as $message)
                            <div class="message col l11 m11 s12">
                                <div class="message-head">
                                    <i class="material-icons hidemessage-icons">arrow_drop_down</i>
                                    <h5 class="content grey-text text-lighten-1">{{ mb_strtoupper(mb_substr($message->user->username, 0, 1)).mb_substr($message->user->username, 1) }}</h5>
                                    <h5 class="content">{{ $message->created_at }}</h5>
                                    <a class="white-text" href="{{ route('thread.show', ['board' => $thread->board->headline, 'thread' => $thread->id]) }}">
                                        <h5 class="content">No. {{ $message->id }}</h5></a>
                                </div>
                                <div class="message-body">
                                    @if(!$message->files->isEmpty())
                                        <div class="message-files">
                                            <div class="row">
                                                @foreach($message->files as $file)
                                                    <message-image src="{{ Storage::disk('s3')->url($file->s3_path) }}" alt="{{ urldecode($file->original_name) }}" size="{{$file->size}}" width="{{$file->width}}" height="{{$file->height}}"></message-image>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div class="container">
                                        @if($message->response_to)
                                            <h6>{{'>> ' . $message->response_to}}</h6>
                                        @endif
                                        <div class="message-text">
                                            <h5>{!! nl2br(e($message->text)) !!}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div id="pages" class="container center">{{ $threads->links('vendor.pagination.materialize') }}</div>
</div>
@endif
@endsection
