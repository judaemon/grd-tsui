<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message->load('user'); // eager load sender if needed
    }

    public function broadcastOn(): Channel
    {
        return new Channel('conversation.' . $this->message->conversation_id);
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'body' => $this->message->body,
            'user_id' => $this->message->user_id,
            'type' => $this->message->type,
            'created_at' => $this->message->created_at->toDateTimeString(),
        ];
    }
}
