<div x-data="{ isOpen: false }" class="relative w-full" wire:keydown.arrow-up.prevent="" wire:keydown.arrow-down.prevent=""
    wire:keydown.enter.prevent='' wire:keydown.escape="isOpen = false" @click.away="isOpen = false">
    <span class="text-gray-500">{{ $label }}</span>
    <div class="border rounded-sm gap-2 cursor-pointer">
        <div class="flex items-center justify-center" @click="isOpen = !isOpen">
            <div class="w-full flex gap-2  p-1">
                @if (!empty($selectedUsers))
                    @foreach ($selectedUsers as $selected)
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-sm flex items-center gap-1">
                            {{ $selected['name'] }}
                            <div class="cursor-pointer text-red-400" @click.stop
                                wire:click='onRemoveOption(@json($selected))'>&times;</div>
                        </span>
                    @endforeach
                @else
                    <span class="text-gray-500">{{ __('Select a User') }}</span>
                @endif
            </div>
            <div class="w-6">
                &#8661;
            </div>
        </div>

        <div x-show="isOpen" class="absolute z-10 bg-white border w-full mt-1 rounded shadow p-2" x-transition>
            <input type="text" wire:model.live.debounce.300ms="query"
                placeholder="{{ __('Search Users') }}" class="border px-3 py-2 w-full rounded">
            <ul>
                @if ($users->isNotEmpty())
                    @foreach ($users as $user)
                        <li wire:click='onSelectOption({{ $user }})' class="px-3 py-2 cursor-pointer">
                            {{ $user->name }}
                        </li>
                    @endforeach
                @else
                    <li class="text-gray-500 px-3 py-2">{{ __('No  users found') }}</li>
                @endif
            </ul>
        </div>

    </div>

    {{-- @if (!empty($selectedUsers))
        <div class="flex flex-wrap gap-2 mb-2">
            @foreach ($selectedUsers as $selected)
                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-sm flex items-center gap-1">
                    {{ $selected['name'] }}
                    <div class="cursor-pointer text-red-400" wire:click='onRemoveOption(@json($selected))'>
                        &times;</div>
                </span>
            @endforeach
        </div>
    @endif



 --}}

</div>
