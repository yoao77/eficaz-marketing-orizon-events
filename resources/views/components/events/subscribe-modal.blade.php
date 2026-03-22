<x-modal name="open-subscribe-modal" focusable>
    <div x-data="{ 
        title: '', 
        action: '' 
    }" @open-subscribe-modal.window="
        title = $event.detail.title; 
        action = $event.detail.action; 
        $dispatch('open-modal', 'open-subscribe-modal')
    " class="p-6">
        
        <form method="POST" :action="action">
            @csrf
            {{-- Coloquei um ícone bonitinho para dar um tchan no front --}}
            <div class="flex items-center mb-4">
                <div class="p-2 bg-green-100 rounded-full mr-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h2 class="text-lg font-medium text-gray-900">
                    Confirm Subscription
                </h2>
            </div>

            <p class="text-sm text-gray-600">
                Are you sure you want to subscribe to the event: 
                <span class="font-bold text-gray-900" x-text="title"></span>?
            </p>

            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>

                <x-primary-button type="submit" class="bg-green-600 hover:bg-green-700">
                    Yes, I want to go!
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
