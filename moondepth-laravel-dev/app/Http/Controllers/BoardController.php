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
     * Show the application board.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Board $board) {

        $boards = parent::getAllBoards();

        $threads = $board->threads()->latest()->paginate(1);

        return view('board.show', compact('boards', 'board', 'threads'));
    }
}
