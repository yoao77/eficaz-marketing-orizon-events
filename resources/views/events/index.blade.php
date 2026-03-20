<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Events') }}
            </h2>
            
            <div class="flex space-x-2">
                <x-secondary-button>
                    {{ __('Filter') }}
                </x-secondary-button>
                <x-primary-button>
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
                    <div class="col-span-full bg-white p-8 rounded-lg shadow text-center">
                        <p class="text-gray-500">Nenhum evento encontrado.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
