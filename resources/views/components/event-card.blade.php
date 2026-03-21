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
            x-on:click.prevent="$dispatch('open-modal', 'subscribed-list-1111111111111111')"
            class="p-2 text-blue-600 hover:bg-blue-50 rounded-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </button>

        <button title="Show"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'show-event-{{ $event->id }}')"
            class="p-2 text-gray-600 hover:bg-gray-50 rounded-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </button>

        <button title="Edit"
            type="button"
            {{-- Aqui está a mágica: passamos o objeto $event para a função global --}}
            onclick='setupEditModal(@json($event))'
            class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </button>

        <button title="Delete"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-event-deletion-{{ $event->id }}')"
            class="p-2 text-red-600 hover:bg-red-50 rounded-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>
    </div>

    <x-modal name="subscribed-list-1111111111111111" maxWidth="sm" focusable>
        <div class="p-6">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="text-lg font-bold text-gray-900">
                    Inscritos
                </h2>
                {{-- Contador: Inscritos / Capacidade --}}
                <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2.5 py-1 rounded-full">
                    {{ count($event->subscribers ?? []) }}/{{ $event->people_capacity ?? '∞' }}
                </span>
            </div>

            {{-- Lista com Scroll --}}
            <ul class="max-h-60 overflow-y-auto divide-y divide-gray-100 pr-2 custom-scrollbar">
                @forelse($event->subscribers ?? [] as $subscriber)
                <li class="py-3 flex items-center">
                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-xs font-bold mr-3">
                        {{ substr($subscriber->name, 0, 2) }}
                    </div>
                    <span class="text-sm text-gray-700 font-medium">{{ $subscriber->name }}</span>
                </li>
                @empty
                <li class="py-8 text-center text-gray-500 text-sm">
                    Nenhum usuário inscrito ainda.
                </li>
                @endforelse
            </ul>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Fechar
                </x-secondary-button>
            </div>
        </div>
    </x-modal>

    <x-modal name="show-event-{{ $event->id }}" maxWidth="2xl" focusable>
        <div class="p-8">
            {{-- Cabeçalho do Modal --}}
            <div class="flex justify-between items-start border-b border-gray-100 pb-4 mb-6">
                <div>
                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Event Details</span>
                    <h2 class="text-2xl font-black text-gray-900 mt-1">
                        {{ $event->title }}
                    </h2>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-mono text-gray-400">ID: #00{{ $event->id ?? '1' }}</span>
                </div>
            </div>

            {{-- Corpo com Informações --}}
            <div class="space-y-6">
                {{-- Descrição --}}
                <div>
                    <h4 class="text-sm font-bold text-gray-800 mb-2 uppercase tracking-tight">Description</h4>
                    <p class="text-gray-600 leading-relaxed bg-gray-50 p-4 rounded-xl border border-gray-100">
                        {{ $event->description }}
                    </p>
                </div>

                {{-- Grid de Informações Secundárias --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Localização --}}
                    <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                        <div class="bg-blue-50 p-2 rounded-lg mr-3 text-xl">📍</div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Location</p>
                            <p class="text-sm font-semibold text-gray-700">{{ $event->location }}</p>
                        </div>
                    </div>

                    {{-- Data e Hora --}}
                    <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                        <div class="bg-green-50 p-2 rounded-lg mr-3 text-xl">📅</div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Date & Time</p>
                            <p class="text-sm font-semibold text-gray-700">10/04/2026 às 14:00</p>
                        </div>
                    </div>

                    {{-- Capacidade --}}
                    <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                        <div class="bg-purple-50 p-2 rounded-lg mr-3 text-xl">👥</div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Capacity</p>
                            <p class="text-sm font-semibold text-gray-700">{{ $event->people_capacity ?? '50' }} people max.</p>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="flex items-center p-3 border border-gray-100 rounded-lg">
                        <div class="bg-orange-50 p-2 rounded-lg mr-3 text-xl">✨</div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-gray-400">Status</p>
                            <p class="text-sm font-semibold text-gray-700 uppercase tracking-wide">{{ $event->status }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer do Modal --}}
            <div class="mt-10 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-6">
                    Close Details
                </x-secondary-button>
            </div>
        </div>
    </x-modal>

    <x-modal name="confirm-event-deletion-{{ $event->id }}" focusable>
    <form method="post" action="{{ route('events.destroy', $event->id) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            Are you sure you want to delete the event: <span class="font-bold">{{ $event->title }}</span>?
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Once this event is deleted, all of its resources and data will be permanently deleted.
        </p>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                Cancel
            </x-secondary-button>

            <x-danger-button class="ml-3">
                Delete Event
            </x-danger-button>
        </div>
    </form>
</x-modal>
</div>
