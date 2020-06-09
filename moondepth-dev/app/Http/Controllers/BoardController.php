<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
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
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse
     */
    public function store(Board $board) {

        ini_set('max_execution_time', 180);

        $data_validator = Validator::make(request()->all(), [
            // 'username' => 'required',
            'topic' => 'required',
            'subject_text' => 'required',
//            'g-recaptcha-response' => 'required|recaptcha'
        ],[
//            'g-recaptcha-response.*' => 'Please ensure that you are a human!'
        ]);

        if ($data_validator->fails()) {
            return redirect()
                ->route('board.show', ['board' => $board->headline])
                ->withErrors($data_validator)
                ->withInput()
                ->with(['is_error' => true]);
        } else {
            $data = $data_validator->valid();
        }

        if(null !== request('file_input')) {

            $requested_validator = Validator::make(request()->all(), [
                'file_input' => 'max:3',
                'file_input.*' => 'image|max:2000',
            ],[
                'file_input.max' => 'Only 3 files are allowed.',
                'file_input.*.image' => 'Only jpeg, png, bmp, gif, or svg are allowed.',
                'file_input.*' => 'Sorry! Maximum allowed size for an image is 2MB.',
//                'file_input.*.max' => 'Sorry! Maximum allowed size for an image is 2MB.',
            ]);
            if ($requested_validator->fails()) {
                return redirect()
                    ->route('board.show', ['board' => $board->headline])
                    ->withErrors($requested_validator)
                    ->withInput()
                    ->with(['is_error' => true]);
            } else {
                $requested_files = $requested_validator->valid();
            }
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
            $intervention_image = Image::make($requested_file->getPathname());
            $image_width = $intervention_image->width();
            $image_height = $intervention_image->height();
            $image_size = $requested_file->getSize();
            $file_data = [
                'tid' => $thread->id,
                's3_path' => $image_path,
                's3_full_path' => $image_full_path,
                'original_name' => $image_original_name,
                'mime_type' => $image_mime_type,
                'width' => $image_width,
                'height' => $image_height,
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
