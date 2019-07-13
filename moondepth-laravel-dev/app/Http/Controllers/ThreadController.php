<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Message;

class ThreadController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome.index');
    }

    /**
     * Store the new application message and redirect to @show.
     *
     * @store \App\Message
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store($board_headline, Thread $thread) {

        $data = request()->validate([
            // 'username' => 'required',
            'message_text' => 'required'
        ]);

        if(request('response_to')) {
            $response_to = ['response_to' => request('response_to')->validate([
                    'response_to' => 'numeric'
                ])
            ];
        } else {
            $response_to = [];
        }

        $message_data = [
            'tid' => $thread->id,
            'uid' => 1,
            'text' => $data['message_text']
        ];

        Message::create(array_merge($message_data, $response_to));
        $thread->update(['amount_of_messages' => ++$thread->amount_of_messages]);

        return redirect(route('thread.show', ['board' => $board_headline, 'thread' => $thread->id]));
    }

    /**
     * Show the application thread.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($board_headline, Thread $thread) {

        $boards = parent::getAllBoards();

        return view('thread.show', compact('boards', 'thread'));
    }
}
