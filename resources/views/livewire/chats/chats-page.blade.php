<div class="flex h-full bg-gray-100">
    <!-- Sidebar for chat contacts -->
    <div class="w-1/4 bg-white border-r border-gray-200 flex flex-col">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Chats</h2>
            <livewire:chats.create-conversation-dialog />
        </div>
        <div class="flex-1 overflow-y-auto">
            @foreach ($this->conversations as $conversation)
                <div class="p-4 hover:bg-gray-50 cursor-pointer {{ $selectedConversation?->id === $conversation->id ? 'bg-blue-100' : '' }}"
                    wire:click="selectConversation({{ $conversation->id }})"
                    wire:key="conversation-{{ $conversation->id }}">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                        <div class="ml-3">
                            <p class="font-medium">{{ $conversation->name ?? 'Direct Chat' }}</p>
                            <p class="text-sm text-gray-500 truncate">
                                {{ $conversation->latestMessage?->body ?? 'No message' }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex flex-col w-3/4 h-full">
        @if ($selectedConversation)
            <div class="p-4 bg-white border-b border-gray-200">
                <h2 class="text-lg font-semibold">{{ $selectedConversation->name ?? 'Direct Chat' }}</h2>
            </div>
            <div class="flex-1 flex flex-col">
                <!-- Messages area -->
                <div class="flex-1 p-4 overflow-y-auto">
                    @if ($selectedConversation->messages->isNotEmpty())
                        @foreach ($selectedConversation->messages as $message)
                            <div
                                class="mb-4 {{ $message->type === 'system' ? 'flex justify-center' : ($message->user_id === auth()->id() ? 'flex justify-end' : 'flex justify-start') }}">
                                <div>
                                    <div
                                        class="inline-block p-3 rounded-lg max-w-xs break-words
                                        {{ $message->type === 'system' ? 'bg-gray-300 text-gray-700 text-sm' : ($message->user_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200') }}">
                                        <p>{{ $message->body }}</p>
                                    </div>
                                    @unless ($message->type === 'system')
                                        <p
                                            class="text-xs text-gray-500 mt-1 {{ $message->user_id === auth()->id() ? 'text-right' : 'text-left' }}">
                                            {{ $message->created_at->format('h:i A') }}
                                        </p>
                                    @endunless
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-500">No messages in this conversation.</p>
                    @endif
                </div>

                <!-- Message input -->
                <div class="p-4 bg-white border-t border-gray-200">
                    <form wire:submit.prevent="sendMessage">
                        <div class="flex items-center">
                            <input type="text" placeholder="Type a message..." class="flex-1 p-2 border rounded-lg"
                                wire:model="messageBody" wire:keydown.enter="sendMessage">
                            <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="flex flex-row w-full h-full justify-center items-center">
                <h2 class="text-lg font-semibold">Select a chat</h2>
            </div>
        @endif
    </div>
</div>
