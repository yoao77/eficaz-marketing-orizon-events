<x-app-layout>

    @if (session('success'))
    <x-toast type="success" :message="session('success')" />
    @endif

    @if ($errors->any())
    <x-toast type="error" :message="$errors->all()" />
    @endif

    <x-slot name="header">
        {{-- Topo: Título e Botão de Criar --}}
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{-- Título dinâmico baseado no filtro --}}
                @if(request('filter') === 'mine')
                {{ __('My Events') }}
                @elseif(request('filter') === 'subscribed')
                {{ __('My Subscriptions') }}
                @else
                {{ __('All Events') }}
                @endif
            </h2>

            <div class="flex space-x-3">
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-event-modal')">
                    {{ __('Create Event') }}
                </x-primary-button>
            </div>
        </div>

        {{-- Linha de Baixo: Navegação por Tabs --}}
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

    <x-events.create-modal />
    <x-events.edit-modal />
    <x-events.show-modal />
    <x-events.subscribers-modal />
    <x-events.delete-modal />

</x-app-layout>
