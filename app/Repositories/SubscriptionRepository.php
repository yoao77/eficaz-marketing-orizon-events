<?php

namespace App\Repositories;

use App\Contracts\SubscriptionRepositoryContract;
use App\Models\EventUser;

class SubscriptionRepository implements SubscriptionRepositoryContract
{
    public function __construct(private EventUser $eventUser) {}

    public function subscribe(int $eventId, int $userId)
    {
        return $this->eventUser->withTrashed()->updateOrCreate(
            ['event_id' => $eventId, 'user_id' => $userId],
            ['deleted_at' => null]
        );
    }

    public function unsubscribe(int $eventId, int $userId)
    {
        $subscription = $this->eventUser
            ->where('event_id', $eventId)
            ->where('user_id', $userId)
            ->first();

        if ($subscription) {
            return $subscription->delete();
        }

        return false;
    }
}
