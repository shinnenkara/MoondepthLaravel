<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store the new application message and redirect to @show.
     *
     * @store \App\Message
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store($board_headline, Thread $thread) {

        ini_set('max_execution_time', 180);

        $data_validator = Validator::make(request()->all(), [
            // 'username' => 'required',
            'message_text' => 'required',
//            'g-recaptcha-response' => 'required|recaptcha'
        ],[
//            'g-recaptcha-response.*' => 'Please ensure that you are a human!'
        ]);

        if ($data_validator->fails()) {
            return redirect()
                ->route('thread.show', ['board' => $board_headline, 'thread' => $thread->id])
                ->withErrors($data_validator)
                ->withInput()
                ->with(['is_error' => true]);
        } else {
            $data = $data_validator->valid();
        }

        if(null !== request('response_to')) {
            $response_to = request()->validate([
                'response_to' => 'numeric'
            ]);
        } else {
            $response_to = [];
        }

        if(null !== request('file_input')) {

            $requested_validator = Validator::make(request()->all(), [
                'file_input' => 'max:3',
                'file_input.*' => 'image|max:2000',
            ],[
                'file_input.max' => 'Only 3 files are allowed.',
                'file_input.*.image' => 'Only jpeg, png, bmp, gif, or svg are allowed.',
                'file_input.*.max' => 'Sorry! Maximum allowed size for an image is 2MB.',
            ]);
            if ($requested_validator->fails()) {
                return redirect()
                    ->route('thread.show', ['board' => $board_headline, 'thread' => $thread->id])
                    ->withErrors($requested_validator)
                    ->withInput()
                    ->with(['is_error' => true]);
            } else {
                $requested_files = $requested_validator->valid();
            }
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

        event(new NewMessage($thread));

        return redirect(route('thread.show', ['board' => $board_headline, 'thread' => $thread->id]));
    }

    /**
     * Show the application thread.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($board_headline, Thread $thread) {

//        $thread = Thread::find(['id' => $thread]);

        // Mailable
        // Mail::to(User::all()->first()->email)->send(new UserResponseMail());

        $boards = parent::getAllBoards();

        return view('thread.show', compact('boards', 'thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }

    /**
     * Event
     *
     * @param  \App\Thread  $thread
     * @param  \Illuminate\Http\Request  $request
     * @return array|false|\Illuminate\Http\Response|string
     */
    public function newMessageEvent(Request $request, $board_headline, Thread $thread)
    {
        $messages = $thread->messages;

        return array('messages' => $messages);
    }
}
