<?php

namespace App\Http\Controllers;

use App\Contracts\CrudContract;
use App\Services\EventService;

class EventController extends Controller 
{
    public function __construct(private EventService $service) {}

    public function index()
    {
        $events = $this->service->index();

        return view('events.index', compact('events'));
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
