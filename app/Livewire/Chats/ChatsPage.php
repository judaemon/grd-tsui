<?php

namespace App\Livewire\Chats;

use App\Events\MessageSent;
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
            // TODO: remove limit implement pagination
            $query->orderBy('created_at', 'asc')->limit(100);
        }])->find($conversationId);

        Log::info($this->selectedConversation);
    }

    public function sendMessage()
    {
        if (!$this->selectedConversation || trim($this->messageBody) === '') {
            return;
        }

        $message = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'user_id' => auth()->id(),
            'body' => $this->messageBody,
            'type' => Message::TYPE_USER,
            'status' => 'sent',
        ]);

        broadcast(new MessageSent($message))->toOthers();

        $this->messageBody = '';
        $this->selectConversation($this->selectedConversation->id);
        $this->loadConversations();
    }

    #[On('refresh-messages')]
    public function refreshMessages()
    {
        if ($this->selectedConversation) {
            $this->selectConversation($this->selectedConversation->id);
            $this->loadConversations();
        }
    }

    public function render()
    {
        return view('livewire.chats.chats-page');
    }
}
