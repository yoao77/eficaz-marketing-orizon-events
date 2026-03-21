<x-modal name="subscribed-list-modal" maxWidth="sm" focusable>
    <div x-data="{ 
        subscribers: [], 
        capacity: '∞' 
    }" 
    @open-subscribers-modal.window="
        subscribers = $event.detail.subscribers || []; 
        capacity = $event.detail.people_capacity || '∞';
        $dispatch('open-modal', 'subscribed-list-modal');
    ">
        <div class="p-6">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="text-lg font-bold text-gray-900">
                   Subscribers 
                </h2>
                {{-- Contador Dinâmico --}}
                <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2.5 py-1 rounded-full">
                    <span x-text="subscribers.length"></span>/<span x-text="capacity"></span>
                </span>
            </div>

            {{-- Lista com Scroll usando Alpine --}}
            <ul class="max-h-60 overflow-y-auto divide-y divide-gray-100 pr-2 custom-scrollbar">
                <template x-for="subscriber in subscribers" :key="subscriber.id">
                    <li class="py-3 flex items-center">
                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs font-bold mr-3">
                            <span x-text="subscriber.name.substring(0, 2).toUpperCase()"></span>
                        </div>
                        <span class="text-sm text-gray-700 font-medium" x-text="subscriber.name"></span>
                    </li>
                </template>

                {{-- Estado Vazio (Equivalente ao @empty) --}}
                <template x-if="subscribers.length === 0">
                    <li class="py-8 text-center text-gray-500 text-sm">
                        No users registered yet.
                    </li>
                </template>
            </ul>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Close 
                </x-secondary-button>
            </div>
        </div>
    </div>
</x-modal>
