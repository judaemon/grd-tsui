<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NumberGenerated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $number;

    public function __construct($number)
    {
        $this->number = $number;
        Log::info("1 Broadcast---------", [$this->number]);
    }

    public function broadcastOn()
    {
        Log::info("2 Broadcast---------", [$this->number]);
        return new Channel('testing-channel');
    }

    public function broadcastAs()
    {
        return 'number.generated';
    }
}