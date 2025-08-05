<?php

namespace App\Livewire\Chats;

use Livewire\Component;
use App\Models\Conversation;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;

class ChatsPage extends Component
{
    use Interactions;

    public $conversations = [];
    public ?Conversation $selectedConversation = null;

    #[On('conversation-created')]
    public function mount()
    {
        $this->conversations = Conversation::all();
    }

    public function selectConversation($conversationId)
    {
        $this->selectedConversation = Conversation::find($conversationId);
    }

    public function render()
    {
        return view('livewire.chats.chats-page');
    }
}
