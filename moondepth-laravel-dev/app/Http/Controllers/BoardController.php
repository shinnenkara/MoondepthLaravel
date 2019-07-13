<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Thread;

class BoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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
     * Store the new application thread and redirect to @show.
     *
     * @store \App\Thread
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Board $board) {

        $data = request()->validate([
            // 'username' => 'required',
            'topic' => 'required',
            'subject_text' => 'required'
        ]);

        Thread::create([
            'bid' => $board->headline,
            'uid' => 1,
            'topic' => $data['topic'],
            'subject_text' => $data['subject_text']
        ]);
        $board->update(['amount_of_threads' => ++$board->amount_of_threads]);

        return redirect(route('board.show', ['board' => $board->headline]));
    }

    /**
     * Show the application board.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Board $board) {

        $boards = parent::getAllBoards();

        $threads = $board->threads()->latest('updated_at')->paginate(5);

        return view('board.show', compact('boards', 'board', 'threads'));
    }
}
