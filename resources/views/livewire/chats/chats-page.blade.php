<div class=" flex h-full bg-gray-100">
    <!-- Sidebar for chat contacts -->
    <div class="w-1/4 bg-white border-r border-gray-200">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold">Chats</h2>
        </div>
        <div class="overflow-y-auto">
            <!-- Sample contact items -->
            <div class="p-4 hover:bg-gray-50 cursor-pointer">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                    <div class="ml-3">
                        <p class="font-medium">John Doe</p>
                        <p class="text-sm text-gray-500">Hey, how's it going?</p>
                    </div>
                </div>
            </div>
            <div class="p-4 hover:bg-gray-50 cursor-pointer">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                    <div class="ml-3">
                        <p class="font-medium">Jane Smith</p>
                        <p class="text-sm text-gray-500">See you tomorrow!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main chat area -->
    <div class="flex-1 flex flex-col">
        <!-- Chat header -->
        <div class="p-4 bg-white border-b border-gray-200">
            <h2 class="text-lg font-semibold">John Doe</h2>
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
    </div>
</div>
