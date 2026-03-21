<?php

namespace App\Contracts;

interface EventRepositoryContract
{
    public function index(array $filters = [], ?int $authUserId);

    public function show(int $id);

    public function store(array $data, int $authUserId);

    public function update(array $data, int $id, int $authUserId);

    public function destroy(int $id, int $authUserId);
}
