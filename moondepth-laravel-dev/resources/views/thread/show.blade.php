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
                <h5 class="content grey-text text-lighten-1">{{ $thread->user->username }}</h5>
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

    <create-message></create-message>

    <div class="thread-messages">
        <div class="row">
            @foreach($thread->messages as $message)
            <div class="message col l11 m11 s12">
                <div class="message-head">
                    <i class="material-icons hidemessage-icons">arrow_drop_down</i>
                    <h5 class="content grey-text text-lighten-1">{{ $message->user->username }}</h5>
                    <h5 class="content">{{ $message->created_at }}</h5>
                    <a class="white-text" href="{{ route('thread.show', ['board' => $thread->board->headline, 'thread' => $thread->id]) }}">
                        <h5 class="content">No. {{ $message->id }}</h5></a>
                </div>
                <div class="message-body">
                    
                    <div class="container">
                        <h5>{{ $message->text }}</h5>
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
