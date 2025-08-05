<div>
    <x-button :text="__('Create New Conversation')" wire:click="$toggle('modal')" sm />

    <x-modal :title="__('Create New Conversation')" wire x-on:open="setTimeout(() => $refs.name.focus(), 250)">
        <form id="conversation-create" wire:submit="save" class="space-y-4">
            <div>
                <x-input label="{{ __('Conversation Name') }}" x-ref="name" wire:model="conversation.name" />
                <p class="text-sm text-gray-500 mt-1">{{ __('Optional, leave blank for direct chats.') }}</p>
            </div>

            <div>
                <x-select.native wire:model="conversation.type" :options="[['name' => 'Direct', 'id' => 'direct'], ['name' => 'Group', 'id' => 'group']]" select="label:name|value:id" />
            </div>
        </form>
        <x-slot:footer>
            <x-button type="submit" form="conversation-create">
                {{ __('Save') }}
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
