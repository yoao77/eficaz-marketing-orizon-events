<?php

namespace App\Repositories;

use App\Contracts\CrudContract;
use App\Models\Event;

class EventRepository implements CrudContract
{
    public function __construct(private Event $event) {}

    public function index()
    {
        return $this->event->orderBy('event_datetime', 'asc')->get();
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
        $event = $this->event->findOrFail($id);

        $event->update([
            'user_id' => $data['user_id'] ?? $event->user_id,
            'title' => $data['title'] ?? $event->title,
            'description' => $data['description'] ?? $event->description,
            'location' => $data['location'] ?? $event->location,
            'event_datetime' => $data['event_datetime'] ?? $event->event_datetime,
            'people_capacity' => $data['people_capacity'] ?? $event->people_capacity,
            'status' => $data['status'] ?? $event->status,
        ]);
    }

    public function destroy(int $id)
    {
        throw new \Exception('Not implemented');
    }
}
