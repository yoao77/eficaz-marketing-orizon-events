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
        throw new \Exception('Not implemented');
    }

    public function store(array $data)
    {
        throw new \Exception('Not implemented');
    }

    public function update(int $id, array $data)
    {
        throw new \Exception('Not implemented');
    }

    public function destroy(int $id)
    {
        throw new \Exception('Not implemented');
    }
}
