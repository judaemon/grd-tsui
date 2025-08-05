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
                            <p class="text-sm text-gray-500">No message</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex flex-row w-full justify-center items-center">
        <h2 class="text-lg font-semibold">Select chats</h2>
    </div>

    {{-- <!-- Main chat area -->
    <div class="flex-1 flex flex-col">
        <!-- Chat header -->
        <div class="p-4 bg-white border-b border-gray-200">
            <h2 class="text-lg font-semibold">Current Conversation</h2>
        </div>

        <!-- Messages area -->
        <div class="flex-1 p-4 overflow-y-auto">
            <!-- Sample messages -->
            <div class="mb-4">
                <div class="inline-block p-3 rounded-lg bg-gray-200">
                    <p>Hello! How are you today?</p>
                </div>
                <p class="text-xs text-gray-500 mt-1">10:30 AM</p>
            </div>
            <div class="mb-4 flex justify-end">
                <div class="inline-block p-3 rounded-lg bg-blue-500 text-white">
                    <p>I'm doing great, thanks!</p>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-1 text-right">10:32 AM</p>
        </div>

        <!-- Message input -->
        <div class="p-4 bg-white border-t border-gray-200">
            <div class="flex items-center">
                <input type="text" placeholder="Type a message..." class="flex-1 p-2 border rounded-lg">
                <button class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg">Send</button>
            </div>
        </div>
    </div> --}}
</div>
