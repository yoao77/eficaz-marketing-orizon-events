<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Services\EventService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function __construct(private EventService $service) {}

    public function index(Request $request)
    {
        try {
            $filters = $request->only(['filter']);
            $authUserId = auth()->id();

            $perPage = $request->input('per_page', 3);

            $events = $this->service->index($filters, $authUserId, (int) $perPage);

            return view('events.index', compact('events'));
        } catch (\Exception $e) {
            Log::error("Error listing events:" . $e->getMessage());

            return view('events.index', [
                'events' => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 5),
                'error' => 'Oops! We had a problem loading the events.'
            ]);
        }
    }

    public function getAll(Request $request)
    {
        $filters = $request->only(['filter']);

        $perPage = (int) $request->input('per_page', 3);

        $authUserId = auth()->id();

        $events = $this->service->index($filters, $authUserId, $perPage);

        return EventResource::collection($events);
    }

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();

        $authUserId = auth()->id();

        $event = $this->service->store($data, $authUserId);

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
        try {
            $data = $request->validated();

            $authUserId = auth()->id();

            $event = $this->service->update($data, $id, $authUserId);

            if ($event) {
                return redirect()
                    ->back()
                    ->with('success', 'Event updated successfully!');
            }
        } catch (ModelNotFoundException $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Event not found.']);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'An unexpected error occurred while updating the event.']);
        }
    }

    public function destroy(int $id)
    {
        try {
            $authUserId = auth()->id();

            $this->service->destroy($id, $authUserId);

            return redirect()
                ->back()
                ->with('success', 'Event deleted successfully!');
        } catch (ModelNotFoundException $e) {
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
