<x-modal name="edit-event-modal" focusable>
    <div x-data="{ 
        action: '',
        event: { title: '', description: '', location: '', event_datetime: '', people_capacity: '', status: '' },
        setData(data) {
            this.event = data;
            this.action = `/events/${data.id}`;
            if(data.event_datetime) {
                // Formata '2026-03-21 14:00:00' para '2026-03-21T14:00'
                this.event.event_datetime = data.event_datetime.replace(' ', 'T').slice(0, 16);
            }
        }
    }" @open-edit-modal.window="setData($event.detail); $dispatch('open-modal', 'edit-event-modal')">
        
        <form :action="action" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <h2 class="text-lg font-medium text-gray-900 mb-4">
                Edit Event: <span class="font-bold text-indigo-600" x-text="event.title"></span>
            </h2>

            <div class="space-y-4">
                {{-- Title --}}
                <div>
                    <x-input-label for="edit_title" value="Title" />
                    <x-text-input x-model="event.title" name="title" type="text" class="mt-1 block w-full" required />
                </div>

                {{-- Description --}}
                <div>
                    <x-input-label for="edit_description" value="Description" />
                    <textarea x-model="event.description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Location --}}
                    <div>
                        <x-input-label for="edit_location" value="Location" />
                        <x-text-input x-model="event.location" name="location" type="text" class="mt-1 block w-full" required />
                    </div>
                    {{-- Date --}}
                    <div>
                        <x-input-label for="edit_event_datetime" value="Date & Time" />
                        <x-text-input x-model="event.event_datetime" name="event_datetime" type="datetime-local" class="mt-1 block w-full" required />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Capacity --}}
                    <div>
                        <x-input-label for="edit_people_capacity" value="People Capacity" />
                        <x-text-input x-model="event.people_capacity" name="people_capacity" type="number" min="1" class="mt-1 block w-full" />
                    </div>
                    {{-- Status --}}
                    <div>
                        <x-input-label for="edit_status" value="Status" />
                        <select x-model="event.status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="active">Active</option>
                            <option value="canceled">Canceled</option>
                            <option value="draft">Draft</option>
                        </select>
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
