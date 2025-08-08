<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserTyping implements ShouldBroadcastNow
{
  use InteractsWithSockets, SerializesModels;

  public $userId;
  public $isTyping;
  public $conversationId;
  /**
   * Create a new event instance.
   */
  public function __construct($userId, $isTyping, $conversationId)
  {
    $this->userId = $userId;
    $this->isTyping = $isTyping;
    $this->conversationId = $conversationId;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return array<int, \Illuminate\Broadcasting\Channel>
   */
  public function broadcastOn(): Channel
  {
    return new Channel("conversation.{$this->conversationId}");
  }
  public function broadcastAs()
  {
    return 'UserTyping';
  }
}
