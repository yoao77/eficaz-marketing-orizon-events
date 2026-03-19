<?php

namespace App\Services;

use App\Contracts\CrudContract;

class EventService {

    public function __construct(private CrudContract $repository) {}

}
