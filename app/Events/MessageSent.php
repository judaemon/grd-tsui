<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; // Changed to ShouldBroadcastNow
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public Message $message;

    public function __construct(Message $message)
    {
        Log::info("MessageSent event constructed", [
            'message_id' => $message->id,
            'conversation_id' => $message->conversation_id,
            'body' => $message->body
        ]);
        $this->message = $message;
        // ->load('user'); // Uncomment if user relationship is needed
    }

    public function broadcastOn(): Channel
    {
        $channel = 'conversation.' . $this->message->conversation_id;
        Log::info("Broadcasting on channel", ['channel' => $channel]);
        return new PrivateChannel($channel);
    }

    public function broadcastAs(): string
    {
        Log::info("Broadcasting as event", ['event' => 'MessageSent']);
        return 'MessageSent';
    }

    public function broadcastWith(): array
    {
        $payload = [
            'id' => $this->message->id,
            'body' => $this->message->body,
            'user_id' => $this->message->user_id,
            'type' => $this->message->type,
            'created_at' => $this->message->created_at->toDateTimeString(),
        ];
        Log::info("Broadcast payload", $payload);
        return $payload;
    }
}
