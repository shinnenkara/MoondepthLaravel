@extends('layouts.app')

@section('title', '/' . $thread->board->headline . '/ — ' . config('app.name', 'Laravel') . ' — ' . $thread->topic)

@section('meta_tags')
<meta name="title" content="{{ '/' . $thread->board->headline . '/ — ' . config('app.name', 'Laravel') . ' — ' . $thread->topic }}">
<meta name="description" content="{{ $thread->topic }}. {{ $thread->subject_text }}. © 2019 Moondepth. All rights reserved. Made by kara_sick">
<meta name="author" content="Kara Sick">
<meta name="keywords" content="moondepth,imageboard,forum,messenger,board,space,{{ $thread->board->headline }},{{ $thread->topic }},kara_sick,2019">
<meta name="robots" content="index,nofollow">
<meta property="og:title" content="{{ '/' . $thread->board->headline . '/ — ' . config('app.name', 'Laravel') . ' — ' . $thread->topic }}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="//moondepth.space/img/png/moondepth.dark.logo.png" />
<meta property="og:image:secure_url" content="{{ asset('img/png/moondepth.dark.logo.png') }}" />
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="300" />
<meta property="og:image:height" content="300" />
<meta property="og:url" content="{{ route('thread.show', ['board' => $thread->board->headline, 'thread' => $thread->id]) }}" />
<meta property="og:description" content="{{ $thread->topic }}. {{ $thread->subject_text }}. © 2019 Moondepth. All rights reserved. Made by kara_sick" />
<meta property="og:site_name" content="Moondepth" />
@endsection

@section('content')
<div id="back-button" class="container white-text">
    <a class="waves-effect waves-light grey darken-3 btn-large" href="/board/{{ $thread->board->headline }}">
        <strong>RETURN TO THE BOARD</strong>
    </a>
</div>
<div class="thread col l12 m12 s12">
    <div id="OP" class="thread-topic">
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
                <h5>{!! nl2br(e($thread->subject_text)) !!}</h5>
            </div>
        </div>
    </div>

    <div id="message-creation" class="container center">
        <create-message is_error="{{ session()->get( 'is_error' ) }}"></create-message>
        <div id="shadow" class="container white-text center">
            <form id="message-form"
                class="col s12"
                method="post"
                action="{{ route('thread.store', ['board' => $thread->board->headline, 'thread' => $thread->id]) }}"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <div class="input-field col s12 m6">
                        <input id="username_input"
                            class="white-text form-control @error('username') is-invalid @enderror"
                            type="text"
                            name="username"
                            value="Anonymous"
                            required
                            data-length="20"
                            autocomplete="username"
                            disabled>
                        <label class="active" for="username_input">Your username</label>
                        <span class="helper-text grey-text text-darken-2 left">You can get recognized</span>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field col s12 m6 ">
                        <input id="response_to_input"
                            class="white-text form-control @error('response_to') is-invalid @enderror"
                            type="text"
                            name="response_to"
                            value="{{ old('response_to') }}"
                            data-length="10">
                        <label for="response_to_input">Response to</label>
                        @error('response_to')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field col s12">
                        <textarea id="message_text_input"
                            class="materialize-textarea white-text form-control @error('message_text') is-invalid @enderror"
                            name="message_text"
                            required
                            data-length="120"
                            autofocus>{{ old('message_text') }}</textarea>
                        <label for="message_text_input">Message text</label>
                        @error('message_text')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>File</span>
                                <input id="file_input"
                                    class="form-control-file"
                                    type="file"
                                    name="file_input[]"
                                    multiple>
                            </div>
                            <div class="file-path-wrapper">
                                <input id="file_path"
                                    class="file-path validate white-text"
                                    type="text"
                                    name="file">
                                <!--placeholder="Upload one or more files" -->
                                <span class="helper-text grey-text text-darken-2 left">Upload up to three files</span>
                            </div>
                            @error('file_input')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('file_input.*')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="center g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                        @error('g-recaptcha-response')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-field col s12">
                        <button id="submit_input" class="white-text waves-effect waves-light grey darken-3 btn-large" type="submit" name="submit" value="send">Send</button>
                    </div>
                    <div class="submit-check col s12">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="thread-messages">
        <div class="row">
            @foreach($thread->messages as $message)
                <div id="message-{{$message->id}}" class="message col l11 m11 s12">
                    <div class="message-head">
                        <i class="material-icons hidemessage-icons">arrow_drop_down</i>
                        <h5 class="content grey-text text-lighten-1">{{ mb_strtoupper(mb_substr($message->user->username, 0, 1)).mb_substr($message->user->username, 1) }}</h5>
                        <h5 class="content">{{ $message->created_at }}</h5>
                        <a class="white-text" href="#m-{{ $message->id }}">
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
                                <a class="white-text" href="#message-{{ $message->response_to }}">
                                    <h6>{{'>>' . $message->response_to}}</h6></a>
                            @endif
                            <h5>{!! nl2br(e($message->text)) !!}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
