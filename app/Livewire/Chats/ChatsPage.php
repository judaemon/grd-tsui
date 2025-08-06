<?php

namespace App\Livewire\Chats;

use Livewire\Component;
use App\Models\Conversation;
use Illuminate\Support\Facades\Log;
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
        $this->loadConversations();
    }

    public function loadConversations()
    {
        $this->conversations = Conversation::with('latestMessage')->get();
    }

    public function selectConversation($conversationId)
    {
        $this->selectedConversation = Conversation::with(['messages' => function ($query) {
            $query->orderBy('created_at', 'asc')->limit(10);
        }])->find($conversationId);

        Log::info($this->selectedConversation);
    }

    public function render()
    {
        return view('livewire.chats.chats-page');
    }
}
