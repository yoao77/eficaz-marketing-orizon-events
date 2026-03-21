<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
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

    public function update(UpdateEventRequest $request, int $id)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        $event = $this->service->update($id, $data);

        if ($event) {
            return redirect()
                ->route('events.index')
                ->with('success', 'Event updated successfully!');
        }

        return back()
            ->withInput()
            ->withErrors(['error' => 'Unable to update the event.']);
    }

    public function destroy(int $id)
    {
        try {
            $userId = auth()->id();

            $this->service->destroy($id, $userId);

            return redirect()
                ->back()
                ->with('success', 'Event deleted successfully!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Event not found.']);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'An unexpected error occurred: ' . $e->getMessage()]);
        }
    }
}
