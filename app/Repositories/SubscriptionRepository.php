<?php

namespace App\Repositories;

use App\Contracts\SubscriptionRepositoryContract;
use App\Models\EventUser;

class SubscriptionRepository implements SubscriptionRepositoryContract
{
    public function __construct(private EventUser $eventUser) {}

    public function getSubscribers(int $eventId)
    {
        return $this->eventUser->findOrFail($eventId)
            ->participants()
            ->select('users.id', 'users.name')
            ->get();
    }

    public function subscribe(int $eventId, int $authUserId)
    {
        return $this->eventUser->withTrashed()->updateOrCreate(
            ['event_id' => $eventId, 'user_id' => $authUserId],
            [
                'deleted_at' => null,
                'canceled_by' => null,
            ]
        );
    }

    public function unsubscribe(int $eventId, int $authUserId)
    {
        $subscription = $this->eventUser
            ->where('event_id', $eventId)
            ->where('user_id', $authUserId)
            ->first();

        if ($subscription) {

            return $subscription->update([
                'canceled_by' => 'user',
            ]);
        }

        return false;
    }
}
