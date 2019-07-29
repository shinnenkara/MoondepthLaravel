<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Thread;
use App\ThreadFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        if(null !== request('file_input')) {

            $requested_files = Validator::make(request()->all(), [
                'file_input' => 'max:3',
                'file_input.*' => 'image|max:5000',
            ],[
                'file_input.max' => 'Only 3 files are allowed.',
                'file_input.*.image' => 'Only jpeg, png, bmp, gif, or svg are allowed.',
                'file_input.*.max' => 'Sorry! Maximum allowed size for an image is 5MB.',
            ])->validate();
        } else {
            $requested_files = ['file_input' => []];
        }

        $thread = Thread::create([
            'bid' => $board->headline,
            'uid' => 1,
            'topic' => $data['topic'],
            'subject_text' => $data['subject_text']
        ]);
        $board->update(['amount_of_threads' => ++$board->amount_of_threads]);

        foreach($requested_files['file_input'] as $requested_file) {
            $image_mime_type = $requested_file->getClientMimeType();
            // $image_path = $requested_file['file_input']->storeAs('active-threads', uniqid("message-img-"), 's3');
            $image_path = Storage::disk('s3')->putFileAs('active-threads', $requested_file, uniqid("message-img-"), 'public');
            $image_full_path = $image_path . '.' . explode('/', $image_mime_type)[1];
            $image_original_name = $requested_file->getClientOriginalName();
            $image_size = $requested_file->getClientSize();
            $file_data = [
                'tid' => $thread->id,
                's3_path' => $image_path,
                's3_full_path' => $image_full_path,
                'original_name' => $image_original_name,
                'mime_type' => $image_mime_type,
                'size' => $image_size
            ];
            $file = ThreadFile::create($file_data);
        }

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
