<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Thread;
use App\Message;
use App\MessageFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Mail\UserResponseMail;
use Illuminate\Support\Facades\Mail;
use App\User;

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
            'message_text' => 'required',
        ]);

        if(null !== request('response_to')) {
            $response_to = request()->validate([
                'response_to' => 'numeric'
            ]);
        } else {
            $response_to = [];
        }

        if(null !== request('file_input')) {

            $requested_files = Validator::make(request()->all(), [
                'file_input.*' => 'image|max:10000'
            ],[
                'file_input.*.image' => 'Only jpeg, png, bmp, gif, or svg are allowed',
                'file_input.*.max' => 'Sorry! Maximum allowed size for an image is 10MB',
            ])->validate();
        } else {
            $requested_files = ['file_input' => []];
        }

        $message_data = [
            'tid' => $thread->id,
            'uid' => 1,
            'text' => $data['message_text']
        ];

        $message = Message::create(array_merge($message_data, $response_to));
        $thread->update(['amount_of_messages' => ++$thread->amount_of_messages]);

        foreach($requested_files['file_input'] as $requested_file) {
            $image_mime_type = $requested_file->getClientMimeType();
            // $image_path = $requested_file['file_input']->storeAs('active-threads', uniqid("message-img-"), 's3');
            $image_path = Storage::disk('s3')->putFileAs('active-threads', $requested_file, uniqid("message-img-"), 'public');
            $image_full_path = $image_path . '.' . explode('/', $image_mime_type)[1];
            $image_original_name = $requested_file->getClientOriginalName();
            $intervention_image = Image::make($requested_file->getPathname());
            $image_width = $intervention_image->width();
            $image_height = $intervention_image->height();
            $image_size = $requested_file->getClientSize();
            $file_data = [
                'mid' => $message->id,
                's3_path' => $image_path,
                's3_full_path' => $image_full_path,
                'original_name' => $image_original_name,
                'mime_type' => $image_mime_type,
                'width' => $image_width,
                'height' => $image_height,
                'size' => $image_size
            ];
            $file = MessageFile::create($file_data);
        }

        return redirect(route('thread.show', ['board' => $board_headline, 'thread' => $thread->id]));
    }

    /**
     * Show the application thread.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($board_headline, Thread $thread) {

        // Mailable
        // Mail::to(User::all()->first()->email)->send(new UserResponseMail());

        $boards = parent::getAllBoards();

        return view('thread.show', compact('boards', 'thread'));
    }
}
