<?php

namespace App\Repositories;

use App\Contracts\EventRepositoryContract;
use App\Models\Event;

class EventRepository implements EventRepositoryContract
{
    public function __construct(private Event $event) {}

    public function index(array $filters = [], int $userId)
    {
        $query = $this->event->query();

        if (isset($filters['filter']) && $filters['filter'] === 'mine') {
            $query->where('user_id', $userId);
        }

        if (isset($filters['filter']) && $filters['filter'] === 'subscribed') {
            $query->whereHas('participants', function ($q) use ($userId) {
                $q->where('user_id', $userId);
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

    public function store(array $data)
    {
        $event = $this->event->create([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'location' => $data['location'],
            'event_datetime' => $data['event_datetime'],
            'people_capacity' => $data['people_capacity'] ?? null,
            'status' => $data['status'] ?? 'active',
        ]);

        return $event;
    }

    public function update(int $id, array $data)
    {
        $event = $this->event->where('user_id', $data['user_id'])->findOrFail($id);

        $event->update($data);

        return $event;
    }

    public function destroy(int $id, int $userId)
    {
        $event = $this->event->where('user_id', $userId)->findOrFail($id);
        return $event->delete();
    }
}
