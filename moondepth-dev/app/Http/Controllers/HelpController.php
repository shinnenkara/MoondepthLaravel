<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;

class HelpController extends Controller
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

        return view('help.index', compact('boards'));
    }
}
