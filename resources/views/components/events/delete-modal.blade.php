<x-modal name="confirm-event-deletion" focusable>
    <div x-data="{ 
        title: '', 
        action: '' 
    }" @open-delete-modal.window="title = $event.detail.title; action = $event.detail.action; $dispatch('open-modal', 'confirm-event-deletion')">
        
        <form method="post" :action="action" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete the event: <span class="font-bold" x-text="title"></span>?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Once this event is deleted, all of its resources and data will be permanently deleted.
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancel
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    Delete Event
                </x-danger-button>
            </div>
        </form>
    </div>
</x-modal>
