<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;

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
     * Show the application thread.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($board, Thread $thread) {

        $boards = parent::getAllBoards();

        return view('thread.show', compact('boards', 'thread'));
    }
}
