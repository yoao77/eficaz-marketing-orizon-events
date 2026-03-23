<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionService;

class SubscriptionController extends Controller
{
    public function __construct(
        private SubscriptionService $service
    ) {}

    public function getSubscribers(int $eventId)
    {
        return $this->service->getSubscribers($eventId, auth()->id());
    }

    public function subscribe(int $eventId)
    {
        try {
            $this->service->subscribe($eventId, auth()->id());

            return redirect()->back()->with('success', 'Subscription confirmed!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function unsubscribe(int $eventId)
    {
        try {
            $this->service->unsubscribe($eventId, auth()->id());

            return redirect()->back()->with('success', 'Your subscription has been successfully cancelled!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
