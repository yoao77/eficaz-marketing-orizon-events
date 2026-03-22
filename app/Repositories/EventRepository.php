<?php

namespace App\Repositories;

use App\Contracts\EventRepositoryContract;
use App\Models\Event;

class EventRepository implements EventRepositoryContract
{
    public function __construct(private Event $event) {}

    public function index(array $filters, ?int $authUserId)
    {
        $query = $this->event->query();

        if (isset($filters['filter']) && $filters['filter'] === 'mine') {
            $query->where('user_id', $authUserId);
        }

        if (isset($filters['filter']) && $filters['filter'] === 'subscribed') {
            $query->whereHas('participants', function ($q) use ($authUserId) {
                $q->where('user_id', $authUserId)
                    ->whereNull('event_user.canceled_by');
            });
        }

        if (empty($filters['filter']) || $filters['filter'] === 'all') {
            $query->where('event_datetime', '>=', now());
        }

        return $query->orderBy('event_datetime', 'asc')->get();
    }

    public function show(int $id)
    {
        return $this->event->findOrFail($id);
    }

    public function store(array $data, int $authUserId)
    {
        $event = $this->event->create([
            'user_id' => $authUserId,
            'title' => $data['title'],
            'description' => $data['description'],
            'location' => $data['location'],
            'event_datetime' => $data['event_datetime'],
            'people_capacity' => $data['people_capacity'] ?? null,
            'status' => $data['status'] ?? 'active',
        ]);

        return $event;
    }

    public function update(array $data, int $id, int $authUserId)
    {
        $event = $this->event->where('user_id', $authUserId)->findOrFail($id);

        $event->update($data);

        return $event;
    }

    public function destroy(int $id, int $authUserId)
    {
        $event = $this->event->where('user_id', $authUserId)->findOrFail($id);

        return $event->delete();
    }

    public function findByIdWithCount(int $id)
    {
        return $this->event->withCount('participants')->findOrFail($id);
    }
}
