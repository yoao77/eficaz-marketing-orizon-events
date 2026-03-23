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
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="create_description" value="Description" />
                <textarea id="create_description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="create_event_datetime" value="Start Date & Time" />
                    <x-text-input id="create_event_datetime" name="event_datetime" type="datetime-local" class="mt-1 block w-full" :value="old('event_datetime')" required />
                    <x-input-error :messages="$errors->get('event_datetime')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="create_end_date" value="End Date & Time" />
                    <x-text-input id="create_end_date" name="end_date" type="datetime-local" class="mt-1 block w-full" :value="old('end_date')" required />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="create_location" value="Location" />
                    <x-text-input id="create_location" name="location" type="text" class="mt-1 block w-full" :value="old('location')" required />
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="people_capacity" value="People Capacity" />
                    <x-text-input id="people_capacity" name="people_capacity" type="number" min="1" class="mt-1 block w-full" :value="old('people_capacity')" />
                    <x-input-error :messages="$errors->get('people_capacity')" class="mt-2" />
                </div>
            </div>
        </div> 

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-primary-button class="ml-3">
                {{ __('Create Event') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>
