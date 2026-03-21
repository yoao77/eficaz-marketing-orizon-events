@props(['event'])

<div class="bg-white shadow-sm rounded-lg p-6 border border-gray-100 flex flex-col justify-between h-full">
    <div>
        <div class="flex justify-between items-start mb-2">
            <h3 class="text-lg font-bold text-gray-900">{{ $event->title }}</h3>
            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $event->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                {{ ucfirst($event->status) }}
            </span>
        </div>

        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $event->description }}</p>

        <div class="space-y-1 text-xs text-gray-500">
            <p>📍 {{ $event->location }}</p>
            <p>📅 {{ \Carbon\Carbon::parse($event->date_time)->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-2 border-t pt-4">

        <button title="Subscribed"
            x-data=""
            x-on:click="$dispatch('open-subscribers-modal', @js($event))"
            class="p-2 text-blue-600 hover:bg-blue-50 rounded-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </button>

        <button title="Show"
            x-data=""
            x-on:click="$dispatch('open-show-modal', @js($event))"
            class="p-2 text-gray-600 hover:bg-gray-50 rounded-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </button>

        <button title="Edit"
            type="button"
            x-data="{}"
            x-on:click.prevent="$dispatch('open-edit-modal', @js($event))"
            class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </button>

        <button title="Delete"
            x-data=""
            x-on:click="$dispatch('open-delete-modal', { title: '{{ $event->title }}', action: '{{ route('events.destroy', $event->id) }}' })"
            class="p-2 text-red-600 hover:bg-red-50 rounded-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>
    </div>
</div>
