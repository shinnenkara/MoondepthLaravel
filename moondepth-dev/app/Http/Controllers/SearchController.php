<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'search' => 'required|min:3',
        ],[
            'search.min' => 'Needed minimum 3 symbols to search!'
        ]);
    }

    /**
     * Show the search result.
     *
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $boards = parent::getAllBoards();

        $data_validator = $this->validator($request->all());

        if ($data_validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($data_validator)
                ->with(['is_error' => true]);
        }

        $data = $data_validator->valid();

        $search_text = $data['search'];
        $threads = Thread::WhereRaw("MATCH(topic, subject_text) AGAINST('$search_text' IN NATURAL LANGUAGE MODE)")->paginate(5);

        return view('search.index', compact('boards', 'threads'));
    }

    public function back()
    {
        return redirect()->back();
    }
}
