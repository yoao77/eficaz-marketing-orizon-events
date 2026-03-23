@props(['event'])
<button title="Cancel Subscription" type="button"
    x-on:click.prevent="$dispatch('open-unsubscribe-modal', { title: '{{ $event->title }}', action: '{{ route('events.unsubscribe', $event->id) }}' })"
    class="p-2 text-orange-600 hover:bg-orange-50 rounded-md transition">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>
