@extends('layouts.app')

@section('title', '/' . $board->headline . '/ — ' . config('app.name', 'Laravel') . ' — ' . $board->description)

@section('meta_tags')
<meta name="title" content="{{ '/' . $board->headline . '/ — ' . config('app.name', 'Laravel') . ' — ' . $board->description }}">
<meta name="description" content="{{ $board->description }}. © 2019 Moondepth. All rights reserved. Made by kara_sick">
<meta name="author" content="Kara Sick">
<meta name="keywords" content="moondepth,imageboard,forum,messenger,board,space,{{ $board->headline }},{{ $board->description }},kara_sick,2019">
<meta name="robots" content="index,follow">
<meta property="og:title" content="{{ '/' . $board->headline . '/ — ' . config('app.name', 'Laravel') . ' — ' . $board->description }}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="//moondepth.space/img/png/moondepth.dark.logo.png" />
<meta property="og:image:secure_url" content="{{ asset('img/png/moondepth.dark.logo.png') }}" />
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="300" />
<meta property="og:image:height" content="300" />
<meta property="og:url" content="{{ route('board.show', ['board' => $board->headline]) }}" />
<meta property="og:description" content="{{ $board->description }}. © 2019 Moondepth. All rights reserved. Made by kara_sick" />
<meta property="og:site_name" content="Moondepth" />
@endsection

@section('content')
<div id="board-welcome" class="container center">
    <h2>Welcome to /{{ $board->headline }}/</h2>
    <h5>{{ $board->description }}</h5>
</div>
<div id="thread-creation" class="container center">
    <create-thread is_error="{{ session()->get( 'is_error' ) }}"></create-thread>
    <div id="shadow" class="container white-text center">
        <form id="thread-form"
            class="col s12"
            method="POST"
            action="{{ route('board.store', ['board' => $board->headline]) }}"
            enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <div class="input-field col s12 m6">
                    <input id="username_input"
                        class="white-text form-control @error('username') is-invalid @enderror"
                        type="text"
                        name="username"
                        @guest
                           value="anonymous"
                        @else
                           value="{{ Auth::user()->username }}"
                        @endguest
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
                <div class="input-field col s12 m6">
                    <input id="topic_input"
                        class="white-text form-control @error('topic') is-invalid @enderror"
                        type="text"
                        name="topic"
                        value="{{ old('topic') }}"
                        required
                        data-length="40"
                        autocomplete="topic"
                        autofocus>
                    <label for="topic_input">Topic</label>
                    @error('topic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-field col s12">
                    <textarea id="subject_text_input"
                        class="materialize-textarea white-text form-control @error('subject_text') is-invalid @enderror"
                        type="textarea"
                        name="subject_text"
                        wrap="soft"
                        required
                        data-length="120">{{ old('subject_text') }}</textarea>
                    <label for="subject_text_input">Subject text</label>
                    @error('subject_text')
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
                <div class="input-field col s12">
                    <div class="center g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                    @error('g-recaptcha-response')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-field col s12">
                    <button id="submit_input" class="white-text waves-effect waves-light grey darken-3 btn-large"
                            type="submit" name="submit" value="send">Create</button>
                </div>
                <div class="submit-check col s12">
                </div>
            </div>
        </form>
    </div>
</div>

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
@endsection
