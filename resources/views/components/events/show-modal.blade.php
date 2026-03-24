<x-modal name="show-event-modal" maxWidth="2xl" focusable>
    <div x-data="{ 
        event: {} 
    }" @open-show-modal.window="event = $event.detail; $dispatch('open-modal', 'show-event-modal')">
        
        <div class="p-12 pb-16"> 
            
            <div class="flex justify-between items-start border-b border-gray-100 pb-6 mb-10">
                <div>
                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Event Details</span>
                    <h2 class="text-3xl font-black text-gray-900 mt-2" x-text="event.title"></h2>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-mono text-gray-400">ID: #00<span x-text="event.id"></span></span>
                </div>
            </div>

            <div class="space-y-10"> 
                
                <div>
                    <h4 class="text-sm font-bold text-gray-800 mb-3 uppercase tracking-tight">Description</h4>
                    <p class="text-gray-600 leading-relaxed bg-gray-50 p-6 rounded-xl border border-gray-100" x-text="event.description"></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div class="flex items-center p-4 border border-gray-100 rounded-lg shadow-sm">
                        <div class="bg-blue-50 p-3 rounded-lg mr-4 text-2xl">📍</div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Location</p>
                            <p class="text-sm font-semibold text-gray-700" x-text="event.location"></p>
                        </div>
                    </div>

                    <div class="flex items-center p-4 border border-gray-100 rounded-lg shadow-sm">
                        <div class="bg-green-50 p-3 rounded-lg mr-4 text-2xl">📅</div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Starts At</p>
                            <p class="text-sm font-semibold text-gray-700" x-text="event.event_datetime"></p>
                        </div>
                    </div>

                    <div class="flex items-center p-4 border border-gray-100 rounded-lg shadow-sm">
                        <div class="bg-red-50 p-3 rounded-lg mr-4 text-2xl">🏁</div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Ends At</p>
                            <p class="text-sm font-semibold text-gray-700" x-text="event.end_date || 'N/A'"></p>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-4 border border-gray-100 rounded-lg shadow-sm">
                        <div class="bg-purple-50 p-3 rounded-lg mr-4 text-2xl">👥</div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Capacity</p>
                            <p class="text-sm font-semibold text-gray-700">
                                <span x-text="event.participants_count || 0"></span> 
                                / 
                                <span x-text="event.people_capacity || '∞'"></span> people
                            </p>
                        </div>
                    </div> 
                </div>
            </div>


            <div class="mt-12 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-8">
                    Close Details
                </x-secondary-button>
            </div>
        </div>
    </div>
</x-modal>
