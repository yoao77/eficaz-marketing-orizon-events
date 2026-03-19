<?php

namespace App\Contracts;

interface CrudContract
{
    public function index(array $filters = []);

    public function show(int $id);

    public function store(array $data);

    public function update(int $id, array $data);

    public function destroy(int $id);
}
