<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(private EventService $service) {}

    public function index(Request $request)
    {
        $filters = $request->only(['filter']);

        $perPage = (int) $request->input('per_page', 3);

        $authUserId = auth()->id();

        $events = $this->service->index($filters, $authUserId, $perPage);

        return EventResource::collection($events);
    }
}
