<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class WelcomeController extends Controller
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
        $boards = parent::getAllBoards();

        $big_board = Board::where(['amount_of_threads' => Board::max('amount_of_threads')])->first();

        $best_board = Board::all()->where('headline', 'a')->first();

        $random_board = Board::inRandomOrder()->first();

        return view('welcome.index', compact('boards', 'big_board', 'best_board', 'random_board'));
    }
}
