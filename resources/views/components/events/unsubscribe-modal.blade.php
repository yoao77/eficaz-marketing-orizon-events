<x-modal name="open-unsubscribe-modal" focusable>
    <div x-data="{ 
        title: '', 
        action: '' 
    }" @open-unsubscribe-modal.window="
        title = $event.detail.title; 
        action = $event.detail.action; 
        $dispatch('open-modal', 'open-unsubscribe-modal')
    " class="p-6">

        <form method="POST" :action="action">
            @csrf
            <div class="flex items-center mb-4">
                <div class="p-2 bg-red-100 rounded-full mr-3">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <h2 class="text-lg font-medium text-gray-900">
                    Cancel Subscription
                </h2>
            </div>

            <p class="text-sm text-gray-600">
                Are you sure you want to leave the event:
                <span class="font-bold text-gray-900" x-text="title"></span>?
            </p>

            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    No, stay
                </x-secondary-button>

                {{-- Botão de Confirmar (Simulando Front-End) --}}
                <x-danger-button type="submit">
                    Yes, Unsubscribe
                </x-danger-button>
            </div>
        </form>
    </div>
</x-modal>
