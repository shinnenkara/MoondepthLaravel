<?php

namespace App\Http\Controllers;

use App\Message;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {

    }

    /**
     * Get the specified resource.
     *
     * @param  \App\Message  $message
     * @return array
     */
    public function get($board, $thread, Message $message)
    {
        $user = $message->user;
        $filesPath = substr(Storage::disk('s3')->url('/'), 0, -1);
        $files = array();

        if(!$message->files->isEmpty()) {
            $files = $message->files;
        }

        return json_encode(array('message' => json_encode($message), 'user' => json_encode($user), 'filesPath' => $filesPath, 'files' => json_encode($files)));
    }

    /**
     * Get all specified resources.
     *
     * @param  \App\Thread  $thread
     * @return array
     */
    public function all(Thread $thread)
    {
        $messages = $thread->messages();

        return array('messages' => $messages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
