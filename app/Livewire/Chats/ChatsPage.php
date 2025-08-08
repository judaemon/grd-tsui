<?php

namespace App\Livewire\Chats;

use App\Events\MessageSent;
use App\Events\UserTyping;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class ChatsPage extends Component
{
    use Interactions;

    public $conversations = [];
    public ?Conversation $selectedConversation = null;
    public string $messageBody = '';
    public bool $isTyping = false;
    public bool $isOtherUserTyping = false;

    #[On('conversation-created')]
    public function mount()
    {
        $this->loadConversations();
    }

    public function loadConversations()
    {
        $this->conversations = Conversation::with('latestMessage')
          ->whereHas('participants', function($query) {
            $query->where('user_id', Auth::id());
          })
          ->get();
    }

    public function usersTyping($status){
      Log::info("User typing status", [
          'user_id' => Auth::id(),
          'is_typing' => $status,
          'conversation_id' => $this->selectedConversation ? $this->selectedConversation->id : null
      ]);
      if($this->selectedConversation){
        $this->isTyping = $status;
        event(new UserTyping(Auth::id(), $this->isTyping, $this->isOtherUserTyping));
      }
    }

    public function selectConversation($conversationId)
    {
        $this->selectedConversation = Conversation::with(['messages' => function ($query) {
            // TODO: remove limit implement pagination
            $query->orderBy('created_at', 'asc')->limit(100);
        }])->find($conversationId);

        Log::info("Selected conversation", ['conversation_id' => $conversationId]);
        $this->dispatch('conversation-selected', conversationId: $conversationId);
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

        Log::info("Message sent", ['message_id' => $message->id]);
        broadcast(new MessageSent($message));

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
            Log::info("Messages refreshed", ['conversation_id' => $this->selectedConversation->id]);
        }
    }

    public function render()
    {
        return view('livewire.chats.chats-page');
    }
}
