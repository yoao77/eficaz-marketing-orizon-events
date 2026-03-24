@props(['event', 'view' => 'all'])

<div x-data="{}" class="bg-white shadow-sm rounded-lg p-6 border border-gray-100 flex flex-col justify-between h-full event-card-container">
    <div class="flex justify-between items-start mb-4">
        <div class="flex flex-col gap-1">
            <h3 class="text-lg font-bold text-gray-900 leading-tight">{{ $event->title }}</h3>

            @if(auth()->check() && in_array(request('filter', 'all'), ['all', 'subscribed']))
            <div>
                @if($event->isUserSubscribed(auth()->id()))
                <span class="px-2 py-0.5 text-[9px] font-black uppercase tracking-wider rounded bg-indigo-100 text-indigo-700 border border-indigo-200">
                    Subscribed
                </span>
                @else
                <span class="px-2 py-0.5 text-[9px] font-black uppercase tracking-wider rounded bg-gray-50 text-gray-400 border border-gray-100">
                    Not Subscribed
                </span>
                @endif
            </div>
            @endif
        </div>

        <span class="shrink-0 px-2 py-1 text-[10px] font-bold uppercase rounded-full {{ $event->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
            {{ $event->status }}
        </span>
    </div>

    <div class="mt-6 flex justify-end space-x-2 border-t pt-4">

        @if(request('filter') === 'mine')
            <x-events.buttons.btn-subscribers :eventId="$event->id" />
            <x-events.buttons.btn-show :event="$event" />
            <x-events.buttons.btn-edit :event="$event" />
            <x-events.buttons.btn-delete :event="$event" />

        @elseif(request('filter') === 'subscribed')
            <x-events.buttons.btn-show :event="$event" />
            <x-events.buttons.btn-unsubscribe :event="$event" />

        @else
            <x-events.buttons.btn-show :event="$event" />

            @if(!$event->isUserSubscribed(auth()->id()))
                <x-events.buttons.btn-subscribe :event="$event" />
            @endif
        @endif
    </div>
</div>
