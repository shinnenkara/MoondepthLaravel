<?php

namespace App\Events;

use App\Message;
use App\Thread;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $thread;

    public $message;

    /**
     * Create a new event instance.
     *
     * @param array $data
     */
    public function __construct(Thread $thread, Message $message)
    {
        $this->thread = $thread;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array|Channel|string
     */
    public function broadcastOn()
    {
        return ["thread." . $this->thread->id . ".new-message"];
//        return new PrivateChannel('channel-name');
    }
}
