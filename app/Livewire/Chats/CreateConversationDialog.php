<?php

namespace App\Livewire\Chats;

use App\Livewire\Traits\Alert;
use App\Models\Conversation;
use App\Models\ConversationUser;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class CreateConversationDialog extends Component
{
    use Alert;

    public bool $modal = false;

    public array $conversation = [
        'name' => '',
        'type' => 'direct',
    ];

    public array $selectedUserIds = [];

    public function getUserOptionsProperty()
    {
        return User::select('id', 'name')->where('id', '!=', auth()->id())->get()->toArray();
    }

    public function save()
    {
        $conversation = Conversation::create($this->conversation);

        // Add the current user as admin
        ConversationUser::create([
            'conversation_id' => $conversation->id,
            'user_id' => auth()->id(),
            'status' => ConversationUser::STATUS_ACTIVE,
            'role' => ConversationUser::ROLE_ADMIN,
            'joined_at' => now(),
        ]);

        // Create initial message for conversation creation
        Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => auth()->id(),
            'body' => auth()->user()->name . ' created this new chat room',
            'type' => Message::TYPE_SYSTEM,
            'status' => 'sent',
        ]);

        // Add selected participants and create messages
        foreach ($this->selectedUserIds as $userId) {
            ConversationUser::create([
                'conversation_id' => $conversation->id,
                'user_id' => $userId,
                'status' => ConversationUser::STATUS_ACTIVE,
                'role' => ConversationUser::ROLE_MEMBER,
                'joined_at' => now(),
            ]);

            // Create message for user addition
            $addedUser = User::find($userId);
            Message::create([
                'conversation_id' => $conversation->id,
                'user_id' => auth()->id(),
                'body' => auth()->user()->name . ' added ' . $addedUser->name,
                'type' => Message::TYPE_SYSTEM,
                'status' => 'sent',
            ]);
        }

        $this->dispatch('conversation-created');
        $this->reset(['modal', 'conversation', 'selectedUserIds']);
        $this->success();
    }

    public function render()
    {
        return view('livewire.chats.create-conversation-dialog', [
            'allUsers' => $this->userOptions,
        ]);
    }
}
