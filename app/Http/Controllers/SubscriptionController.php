<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionService;

class SubscriptionController extends Controller
{
    public function __construct(
        private SubscriptionService $service
    ) {}

    public function subscribe(int $id)
    {
        try {
            $this->service->subscribe($id, auth()->id());

            return redirect()->back()->with('success', 'Subscription confirmed!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
