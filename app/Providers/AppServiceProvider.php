<?php

namespace App\Providers;

use App\Contracts\EventRepositoryContract;
use App\Contracts\SubscriptionRepositoryContract;
use App\Repositories\EventRepository;
use App\Repositories\SubscriptionRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventRepositoryContract::class, EventRepository::class);
        $this->app->bind(SubscriptionRepositoryContract::class, SubscriptionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
