@extends('layouts.app')

@section('content')
<div id="board-welcome" class="container center">
    <h2>Welcome to /{{ $board->headline }}/</h2>
    <h5>{{ $board->description }}</h5>
</div>
<div id="thread-creation" class="container center">
    <create-thread></create-thread>
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
                    <button id="submit_input" class="white-text waves-effect waves-light grey darken-3 btn-large" type="submit" name="submit" value="send">Send</button>
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
                    <div class="container">
                        <h5>{{ $thread->subject_text }}</h5></span>
                    </div>
                </div>
                <div class="thread-files">
                    <div class="row">
                        @foreach($thread->files as $file)
                        <div class="mimg col s10 m12 l4">
                            <img style="width: 100%; height: 100%;" src="{{ Storage::disk('s3')->url($file->s3_path) }}" alt="{{ urldecode($file->original_name) }}">
                        </div>
                        @endforeach
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
                            <div class="container">
                                <h5>{{ $message->text }}</h5>
                            </div>
                        </div>
                        <div class="message-files">
                            <div class="row">
                                @foreach($message->files as $file)
                                <div class="mimg col s10 m12 l4">
                                    <img style="width: 100%; height: 100%;" src="{{ Storage::disk('s3')->url($file->s3_path) }}" alt="{{ urldecode($file->original_name) }}">
                                </div>
                                @endforeach
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
