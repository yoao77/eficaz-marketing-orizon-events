<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
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

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        $event = $this->service->store($data);

        if ($event) {
            return redirect()
                ->back()
                ->with('success', 'Event created with success!');
        }

        return back()
            ->withInput()
            ->withErrors(['error' => 'Could not create event']);
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
