<?php

namespace App\Contracts;

interface EventRepositoryContract
{
    public function index(array $filters = [], int $userId);

    public function show(int $id);

    public function store(array $data);

    public function update(int $id, array $data);

    public function destroy(int $id, int $userId);
}
