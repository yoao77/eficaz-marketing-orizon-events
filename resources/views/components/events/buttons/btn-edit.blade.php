@props(['event'])
<button title="Edit" type="button"
    x-on:click.prevent="$dispatch('open-edit-modal', @js($event))"
    class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-md transition">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
    </svg>
</button>
