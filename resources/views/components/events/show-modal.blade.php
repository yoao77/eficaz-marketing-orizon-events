<x-modal name="show-event-modal" maxWidth="2xl" focusable>
    <div x-data="{ 
        event: {} 
    }" @open-show-modal.window="event = $event.detail; $dispatch('open-modal', 'show-event-modal')">
        
        <div class="p-8">
            <div class="flex justify-between items-start border-b border-gray-100 pb-4 mb-6">
                <div>
                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Event Details</span>
                    <h2 class="text-2xl font-black text-gray-900 mt-1" x-text="event.title"></h2>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-mono text-gray-400">ID: #00<span x-text="event.id"></span></span>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <h4 class="text-sm font-bold text-gray-800 mb-2 uppercase tracking-tight">Description</h4>
                    <p class="text-gray-600 leading-relaxed bg-gray-50 p-4 rounded-xl border border-gray-100" x-text="event.description"></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                        <div class="bg-blue-50 p-2 rounded-lg mr-3 text-xl">📍</div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Location</p>
                            <p class="text-sm font-semibold text-gray-700" x-text="event.location"></p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                        <div class="bg-green-50 p-2 rounded-lg mr-3 text-xl">📅</div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Date & Time</p>
                            <p class="text-sm font-semibold text-gray-700" x-text="event.date_time"></p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                        <div class="bg-purple-50 p-2 rounded-lg mr-3 text-xl">👥</div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Capacity</p>
                            <p class="text-sm font-semibold text-gray-700"><span x-text="event.people_capacity || '∞'"></span> people max.</p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                        <div class="bg-orange-50 p-2 rounded-lg mr-3 text-xl">✨</div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Status</p>
                            <p class="text-sm font-semibold text-gray-700 uppercase tracking-wide" x-text="event.status"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-6">
                    Close Details
                </x-secondary-button>
            </div>
        </div>
    </div>
</x-modal>
