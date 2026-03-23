<?php

namespace App\Services;

use App\Contracts\SubscriptionRepositoryContract;
use App\Repositories\EventRepository;
use Exception;

class SubscriptionService
{
    public function __construct(
        private SubscriptionRepositoryContract $repository,
        private EventRepository $eventRepository
    ) {}

    public function getSubscribers(int $eventId, int $authUserId)
    {
        $event = $this->eventRepository->findById($eventId);

        if (! $event) {
            throw new Exception('Event not found.');
        }

        if ($event->user_id !== $authUserId) {
            throw new Exception('You are not authorized to view this subscriber list.');
        }

        return [
            'subscribers' => $event->participants()
                ->select('users.id', 'users.name')
                ->get(),
            'people_capacity' => $event->people_capacity ?? '∞',
        ];
    }

    public function subscribe(int $eventId, int $authUserId)
    {
        $event = $this->eventRepository->findByIdWithCount($eventId);

        if (! $event->isActive()) {
            throw new Exception('This event is no longer active or has already passed.');
        }

        if ($event->isUserSubscribed($authUserId)) {
            throw new Exception('You are already registered for this event!');
        }

        if ($event->isFull()) {
            throw new Exception('The event is full!');
        }

        return $this->repository->subscribe($eventId, $authUserId);
    }

    public function unsubscribe(int $eventId, int $authUserId)
    {
        $event = $this->eventRepository->findByIdWithCount($eventId);

        if (in_array($event->status, ['canceled', 'in_progress'])) {
            throw new Exception("You cannot unsubscribe from an event that is already {$event->status}!");
        }

        if (! $event->isUserSubscribed($authUserId)) {
            throw new Exception('You are not registered for this event!');
        }

        return $this->repository->unsubscribe($eventId, $authUserId);
    }
}
