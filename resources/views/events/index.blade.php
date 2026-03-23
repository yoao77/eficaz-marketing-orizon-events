<x-app-layout>

    @if (session('success'))
    <x-toast type="success" :message="session('success')" />
    @endif

    @if ($errors->any())
    <x-toast type="error" :message="$errors->all()" />
    @endif

    <x-slot name="header">

        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">

                @if(request('filter') === 'mine')
                {{ __('My Events') }}
                @elseif(request('filter') === 'subscribed')
                {{ __('My Subscriptions') }}
                @else
                {{ __('All Events') }}
                @endif
            </h2>

            @if(request('filter') === 'mine')
            <div class="flex space-x-3">
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-event-modal')">
                    {{ __('Create Event') }}
                </x-primary-button>
            </div>
            @endif

        </div>

        <nav class="flex space-x-8 border-b border-gray-100">
            <x-tab-item
                :href="route('events.index')"
                :active="!request('filter')">
                {{ __('All') }}
            </x-tab-item>

            <x-tab-item
                :href="route('events.index', ['filter' => 'mine'])"
                :active="request('filter') === 'mine'">
                {{ __('My Events') }}
            </x-tab-item>

            <x-tab-item
                :href="route('events.index', ['filter' => 'subscribed'])"
                :active="request('filter') === 'subscribed'">
                {{ __('Subscribed') }}
            </x-tab-item>
        </nav>

    </x-slot>

    <div class="mb-4 p-4 bg-blue-50 dark:bg-gray-800 rounded-lg flex justify-between items-center shadow-sm border border-blue-100 dark:border-gray-700">
        <span class="text-sm font-medium text-blue-800 dark:text-blue-300">
            Total events rendered on this page: <span id="js-event-count" class="font-bold">0</span>
        </span>
        <span id="js-clock" class="text-xs text-blue-600 dark:text-gray-400 font-mono"></span>
    </div>

    @if(isset($error) || $errors->has('error'))
    <div class="mb-6 flex items-center p-4 text-red-800 border-l-4 border-red-500 bg-red-50 rounded-r-lg shadow-sm" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        </svg>
        <div class="text-sm font-bold">
            {{ $error ?? $errors->first('error') }}
        </div>
    </div>
    @endif

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
        <div class="mt-6"> 
            {{ $events->appends(request()->query())->links() }}
        </div>
    </div>
    
    <x-events.create-modal />
    <x-events.edit-modal />
    <x-events.show-modal />
    <x-events.subscribers-modal />
    <x-events.delete-modal />
    <x-events.subscribe-modal />
    <x-events.unsubscribe-modal />

</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const eventCards = document.querySelectorAll('.event-card-container');
        const countDisplay = document.getElementById('js-event-count');

        if (countDisplay) {
            countDisplay.innerText = eventCards.length;
        }

        const clockDisplay = document.getElementById('js-clock');

        setInterval(() => {
            const now = new Date();
            clockDisplay.innerText = '🕒 ' + now.toLocaleTimeString();
        }, 1000);

        console.log('Pure JavaScript: Count and Clock started!');
    });
</script>
