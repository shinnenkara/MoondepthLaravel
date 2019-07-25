@extends('layouts.app')

@section('content')
<div id="back-button" class="container white-text">
    <a class="waves-effect waves-light grey darken-3 btn-large" href="/board/{{ $thread->board->headline }}">
        <strong>RETURN TO THE BOARD</strong>
    </a>
</div>
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
    </div>

    <div id="message-creation" class="container center">
        <create-message></create-message>
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
                            value="{{ old('message_text') }}"
                            required
                            data-length="120"
                            autofocus>
                        </textarea>
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
                                    name="file_input"
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

    <div class="thread-messages">
        <div class="row">
            @foreach($thread->messages as $message)
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
                <div class="row">
                    @foreach($message->files as $file)
                    <div class="mimg col s10 m12 l4">
                        <img style="width: 100%; height: 100%;" src="{{ Storage::disk('s3')->url($file->s3_path) }}" alt="{{ urldecode($file->original_name) }}">
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
