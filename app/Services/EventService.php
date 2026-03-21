<?php

namespace App\Services;

use App\Contracts\EventRepositoryContract;

class EventService
{
    public function __construct(private EventRepositoryContract $repository) {}

    public function index(array $filters = [], $userId)
    {
        return $this->repository->index($filters, $userId);
    }

    public function show(int $id)
    {
        return $this->repository->show($id);
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function destroy(int $id, int $userId)
    {
        return $this->repository->destroy($id, $userId);
    }
}
