<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">My Events</h2>
            <div class="flex space-x-3">
                <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'filter-modal')">
                    {{ __('Filter') }}
                </x-secondary-button>

                <x-primary-button x-data="" x-on:click.prevent="setupCreateModal()">
                    {{ __('Create Event') }}
                </x-primary-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($events as $event)
                <x-event-card :event="$event" />
                @empty
                <div class="col-span-full bg-white p-12 rounded-xl text-center border-2 border-dashed border-gray-200">
                    <p class="text-gray-500">Nenhum evento encontrado.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- FORM MODAL --}}
    <x-modal name="event-modal" focusable>
        <form id="eventForm" method="POST" class="p-6">
            @csrf
            <div id="methodPut"></div>

            <h2 id="eventModalLabel" class="text-lg font-medium text-gray-900 mb-4">
                Create New Event
            </h2>

            <div class="space-y-4">
                {{-- Title --}}
                <div>
                    <x-input-label for="title" value="Title" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                </div>

                {{-- Description --}}
                <div>
                    <x-input-label for="description" value="Description" />
                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Location --}}
                    <div>
                        <x-input-label for="location" value="Location" />
                        <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" required />
                    </div>
                    {{-- Event Datetime --}}
                    <div>
                        <x-input-label for="event_datetime" value="Date & Time" />
                        <x-text-input id="event_datetime" name="event_datetime" type="datetime-local" class="mt-1 block w-full" required />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- People Capacity --}}
                    <div>
                        <x-input-label for="people_capacity" value="People Capacity" />
                        <x-text-input id="people_capacity" name="people_capacity" type="number" min="1" class="mt-1 block w-full" />
                    </div>
                    {{-- Status --}}
                    <div>
                        <x-input-label for="status" value="Status" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="active">Active</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                <x-primary-button class="ml-3">Save Changes</x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>

