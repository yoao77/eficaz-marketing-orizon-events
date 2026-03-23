<?php

namespace App\Services;

use App\Contracts\EventRepositoryContract;

class EventService
{
    public function __construct(private EventRepositoryContract $repository) {}

    public function index(array $filters, ?int $authUserId)
    {
        return $this->repository->index($filters, $authUserId);
    }

    public function getAll() {
        $events = $this->repository->index([], null); 

        return $events->loadCount('participants');
    }

    public function store(array $data, int $authUserId)
    {
        return $this->repository->store($data, $authUserId);
    }

    public function update(array $data, int $id, int $authUserId)
    {
        return $this->repository->update($data, $id, $authUserId);
    }

    public function destroy(int $id, int $authUserId)
    {
        return $this->repository->destroy($id, $authUserId);
    }
}
