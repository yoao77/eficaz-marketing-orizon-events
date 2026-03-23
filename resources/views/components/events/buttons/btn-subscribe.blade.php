@props(['event'])
<button title="Subscribe" type="button"
    x-on:click.prevent="$dispatch('open-subscribe-modal', { title: '{{ $event->title }}', action: '{{ route('events.subscribe', $event->id) }}' })"
    class="p-2 text-green-600 hover:bg-green-50 rounded-md transition">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
</button>
