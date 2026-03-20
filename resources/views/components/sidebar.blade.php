<div class="container-fluid pt-4">
    <div class="row">
        <aside class="col-md-3 col-lg-2 mb-4">
            <div class="list-group shadow-sm">
                <div class="list-group-item bg-light border-bottom-0">
                    <span class="text-uppercase fw-bold text-muted" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
                        Events
                    </span>
                </div>

                <a href="{{ route('dashboard') }}" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event me-2"></i> My
                </a>

                <a href="#" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('events.global') ? 'active' : '' }}">
                    <i class="bi bi-search me-2"></i> Global
                </a>

                <a href="#" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('events.subscribed') ? 'active' : '' }}">
                    <i class="bi bi-bookmark-check me-2"></i> Subscribed
                </a>
            </div>
        </aside>

        <main class="col-md-9 col-lg-10">
             {{ $slot }}
        </main>
    </div>
</div>
