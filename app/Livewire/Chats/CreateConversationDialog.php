<?php

namespace App\Livewire\Chats;

use App\Livewire\Traits\Alert;
use App\Models\Conversation;
use Livewire\Component;

class CreateConversationDialog extends Component
{
    use Alert;

    public bool $modal = false;

    public array $conversation = [
        'name' => '',
        'type' => 'direct',
    ];

    public function save()
    {
        Conversation::create($this->conversation);

        $this->dispatch('conversation-created');
        $this->reset();
        $this->modal = false;
        $this->success();
    }

    public function render()
    {
        return view('livewire.chats.create-conversation-dialog');
    }
}
