<x-modal name="create-event-modal" focusable>
    <form action="{{ route('events.store') }}" method="POST" class="p-6">
        @csrf
        <h2 class="text-lg font-medium text-gray-900 mb-4">
            {{ __('Create New Event') }}
        </h2>

        <div class="space-y-4">

            <div>
                <x-input-label for="create_title" value="Title" />
                <x-text-input id="create_title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required />
            </div>

            <div>
                <x-input-label for="create_description" value="Description" />
                <textarea id="create_description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="create_location" value="Location" />
                    <x-text-input id="create_location" name="location" type="text" class="mt-1 block w-full" :value="old('location')" required />
                </div>
                <div>
                    <x-input-label for="create_event_datetime" value="Date & Time" />
                    <x-text-input id="create_event_datetime" name="event_datetime" type="datetime-local" class="mt-1 block w-full" :value="old('event_datetime')" required />
                </div>
            </div>
             
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
            <x-primary-button class="ml-3">Create Event</x-primary-button>
        </div>
    </form>
</x-modal>
