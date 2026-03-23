<x-modal name="edit-event-modal" focusable>
    <div x-data="{ 
        id: '',
        title: '{{ old('title', '') }}',
        description: '{{ old('description', '') }}',
        location: '{{ old('location', '') }}',
        event_datetime: '{{ old('event_datetime', '') }}',
        end_date: '{{ old('end_date', '') }}',
        people_capacity: '{{ old('people_capacity', '') }}',
        status: '{{ old('status', 'active') }}',
        action: '',

        get now() {
            return new Date().toLocaleString('sv-SE').replace(' ', 'T').substring(0, 16);
        },

        setData(data) {
            this.id = data.id;
            this.title = data.title;
            this.description = data.description;
            this.location = data.location;
            this.people_capacity = data.people_capacity;
            this.status = data.status;
            this.action = '/events/' + data.id;

            const format = (d) => d ? d.replace(' ', 'T').slice(0, 16) : '';
            this.event_datetime = format(data.event_datetime);
            this.end_date = format(data.end_date);
        }
    }" 
    {{-- Abre o modal se tiver erro no PHP --}}
    x-init="if ('{{ $errors->any() }}') { $dispatch('open-modal', 'edit-event-modal') }"
    @open-edit-modal.window="setData($event.detail); $dispatch('open-modal', 'edit-event-modal')">
        
        <form :action="action" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <h2 class="text-lg font-medium text-gray-900 mb-4">
                Edit Event: <span class="font-bold text-indigo-600" x-text="title"></span>
            </h2>

            <div class="space-y-4">
                <div>
                    <x-input-label value="Title" />
                    <x-text-input x-model="title" name="title" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('title')" />
                </div>

                <div>
                    <x-input-label value="Description" />
                    <textarea x-model="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label value="Start Date & Time" />
                        <x-text-input 
                            x-model="event_datetime" 
                            name="event_datetime" 
                            type="datetime-local" 
                            class="mt-1 block w-full" 
                            ::min="now" 
                            required 
                        />
                    </div>
                    <div>
                        <x-input-label value="End Date & Time" />
                        <x-text-input 
                            x-model="end_date" 
                            name="end_date" 
                            type="datetime-local" 
                            class="mt-1 block w-full" 
                            ::min="event_datetime || now" 
                            required 
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label value="Location" />
                        <x-text-input x-model="location" name="location" type="text" class="mt-1 block w-full" required />
                    </div>
                    <div>
                        <x-input-label value="Capacity" />
                        <x-text-input x-model="people_capacity" name="people_capacity" type="number" class="mt-1 block w-full" />
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                <x-primary-button class="ml-3">Update Event</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
