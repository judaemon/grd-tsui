<div x-data="{ type: @entangle('conversation.type') }">
    <x-button :text="__('Create New Conversation')" wire:click="$toggle('modal')" sm />

    <x-modal :title="__('Create New Conversation')" wire x-on:open="setTimeout(() => $refs.name.focus(), 250)">
        <form id="conversation-create" wire:submit="save" class="space-y-4">
            <div>
                <x-input label="{{ __('Conversation Name') }}" x-ref="name" wire:model="conversation.name" />
                <p class="text-sm text-gray-500 mt-1">{{ __('Optional, leave blank for direct chats.') }}</p>
            </div>

            <div>
                <x-select.native label="Type" wire:model="conversation.type" :options="[['name' => 'Direct', 'id' => 'direct'], ['name' => 'Group', 'id' => 'group']]"
                    select="label:name|value:id" />
            </div>

            <!-- Show participants selector only if type is "group" -->
            <div x-show="type === 'group'" x-transition>
                <x-select.styled label="Select Participants" wire:model="selectedUserIds" :options="$allUsers" multiple
                    value-field="id" text-field="name" select="label:name|value:id" multiple />
            </div>
            <livewire:search-users :isMultiple="false"/>
        </form>

        <x-slot:footer>
            <x-button type="submit" form="conversation-create">
                {{ __('Save') }}
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
