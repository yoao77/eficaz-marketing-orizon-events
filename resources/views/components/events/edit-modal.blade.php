<x-modal name="edit-event-modal" focusable>
    <div x-data="{ 
        event: {}, 
        action: '',
        
        format(d) {
            return d ? d.replace(' ', 'T').substring(0, 16) : '';
        },

        setData(data) {
            this.event = { ...data };
            this.action = '/events/' + data.id;
            
            this.event.event_datetime = this.format(data.event_datetime);
            this.event.end_date = this.format(data.end_date);
        }
    }"
    x-init="if ('{{ $errors->any() }}') { $dispatch('open-modal', 'edit-event-modal') }"
    @open-edit-modal.window="setData($event.detail); $dispatch('open-modal', 'edit-event-modal')"
    >
        <form :action="action" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <h2 class="text-lg font-medium text-gray-900 mb-4">
                Edit Event: <span class="font-bold text-indigo-600" x-text="event.title"></span>
            </h2>

            <div class="space-y-4">
                <div>
                    <x-input-label value="Title" />
                    <x-text-input x-model="event.title" name="title" type="text" class="mt-1 block w-full" required />
                </div>

                <div>
                    <x-input-label value="Description" />
                    <textarea x-model="event.description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label value="Start Date" />
                        <x-text-input x-model="event.event_datetime" name="event_datetime" type="datetime-local" class="mt-1 block w-full" required />
                    </div>
                    <div>
                        <x-input-label value="End Date" />
                        <x-text-input x-model="event.end_date" name="end_date" type="datetime-local" class="mt-1 block w-full" required />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label value="Location" />
                        <x-text-input x-model="event.location" name="location" type="text" class="mt-1 block w-full" required />
                    </div>
                    <div>
                        <x-input-label value="Capacity" />
                        <x-text-input x-model="event.people_capacity" name="people_capacity" type="number" class="mt-1 block w-full" />
                    </div>
                </div>

                <div>
                    <x-input-label value="Status" />
                    <select x-model="event.status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="active">Active</option>
                        <option value="canceled">Canceled</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                <x-primary-button class="ml-3">Update</x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
