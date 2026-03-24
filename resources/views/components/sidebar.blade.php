<div class="w-full flex flex-col p-4">
    <div class="mb-4 px-2">
        <span class="text-uppercase font-bold text-gray-400 text-[0.7rem] tracking-widest uppercase">
            Events
        </span>
    </div>

    <nav class="space-y-1">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100' }}">
            <i class="bi bi-calendar-event mr-3"></i> My
        </a>

        <a href="#" 
           class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
            <i class="bi bi-search mr-3"></i> Global
        </a>

        <a href="#" 
           class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
            <i class="bi bi-bookmark-check mr-3"></i> Subscribed
        </a>
    </nav>
</div>
