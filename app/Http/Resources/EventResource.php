<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'starts_at' => $this->event_datetime ? $this->event_datetime->format('Y-m-d H:i') : null,
            'location' => $this->location,
            'ends_at' => $this->end_date ? $this->end_date->format('Y-m-d H:i') : null,
            'capacity' => (int) $this->people_capacity,
            'subscribers_count' => (int) ($this->participants_count ?? 0),
        ];
    }
}
