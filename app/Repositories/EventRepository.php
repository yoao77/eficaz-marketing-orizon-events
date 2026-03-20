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
        $event = $event = $this->event->where('user_id', $data['user_id'])->findOrFail($id);

        $event->update($data); 

        return $event;
    }

    public function destroy(int $id)
    {
        $event = $this->event->findOrFail($id);

        $event->delete();

        return true;
    }
}
