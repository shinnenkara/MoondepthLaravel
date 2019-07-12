@extends('layouts.app')

@section('content')
<div id="board-welcome" class="container center">
    <h2>Welcome to /{{ $board->headline }}/</h2>
    <h5>{{ $board->description }}</h5>
</div>

<create-thread></create-thread>

<div id="board-threads" class="">
    <div class="row">
        @foreach($threads as $thread)
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

            <div class="thread-messages">
                <div class="row">
                    @foreach($thread->messages()->latest()->limit(3)->get()->reverse() as $message)
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
        @endforeach
    </div>
    <div id="pages" class="container center">{{ $threads->links('vendor.pagination.materialize') }}</div>
</div>
@endsection
