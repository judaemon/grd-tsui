<?php

namespace App\Livewire\Chats;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;

class ChatsPage extends Component
{
    use Interactions;

    public $conversations = [];
    public ?Conversation $selectedConversation = null;
    public string $messageBody = '';

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

    public function sendMessage()
    {
        if (!$this->selectedConversation || trim($this->messageBody) === '') {
            return;
        }

        Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'user_id' => auth()->id(),
            'body' => $this->messageBody,
            'type' => 'user',
        ]);

        $this->messageBody = '';
        $this->selectConversation($this->selectedConversation->id);
        $this->loadConversations();
    }

    public function render()
    {
        return view('livewire.chats.chats-page');
    }
}
