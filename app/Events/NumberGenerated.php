<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NumberGenerated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function broadcastOn()
    {
        return new Channel('testing-channel');
    }

    public function broadcastAs()
    {
        return 'number.generated';
    }
}