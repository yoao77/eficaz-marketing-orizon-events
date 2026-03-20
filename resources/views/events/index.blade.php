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
                    <p class="text-gray-500">No events found.</p>
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

    {{-- FILTER MODAL --}}
    <x-modal name="filter-modal" maxWidth="md">
        <form action="{{ route('dashboard') }}" method="GET" class="p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 border-b pb-2">Filter Events</h2>

            <div class="space-y-4">
                {{-- Status --}}
                <div>
                    <x-input-label for="filter_status" value="Status" />
                    <select name="status" id="filter_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">All Statuses</option>
                        <option value="active">Active Only</option>
                        <option value="canceled">Canceled Only</option>
                    </select>
                </div>

                {{-- Date Range --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="date_from" value="From Date" />
                        <x-text-input id="date_from" name="date_from" type="date" class="mt-1 block w-full" />
                    </div>
                    <div>
                        <x-input-label for="date_to" value="To Date" />
                        <x-text-input id="date_to" name="date_to" type="date" class="mt-1 block w-full" />
                    </div>
                </div>
            </div>

            <div class="mt-8 flex flex-col gap-2">
                <x-primary-button class="w-full justify-center py-3">
                    Apply Filters
                </x-primary-button>
                <a href="{{ route('dashboard') }}" class="text-center text-sm text-gray-500 hover:text-indigo-600 transition-colors">
                    Clear Filters
                </a>
            </div>
        </form>
    </x-modal>

</x-app-layout>

<script>
    const eventForm = document.getElementById('eventForm');
    const methodPut = document.getElementById('methodPut');

    function setupCreateModal() {
        document.getElementById('eventModalLabel').innerText = 'Create New Event';

        eventForm.action = "/events";

        methodPut.innerHTML = '';
        eventForm.reset();
        window.dispatchEvent(new CustomEvent('open-modal', {
            detail: 'event-modal'
        }));
    }

    function setupEditModal(event) {
        document.getElementById('eventModalLabel').innerText = 'Edit: ' + event.title;
        eventForm.action = `/events/${event.id}`;
        methodPut.innerHTML = '<input type="hidden" name="_method" value="PUT">';

        document.getElementById('title').value = event.title;
        document.getElementById('description').value = event.description;
        document.getElementById('location').value = event.location;
        document.getElementById('date_time').value = event.date_time.replace(' ', 'T');

        window.dispatchEvent(new CustomEvent('open-modal', {
            detail: 'event-modal'
        }));
    }

</script>
