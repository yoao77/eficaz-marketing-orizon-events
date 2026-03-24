<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\EventUser;
use App\Models\User;
use App\Services\SubscriptionService;
use App\Repositories\EventRepository;
use App\Repositories\SubscriptionRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SubscriptionIntegrationTest extends TestCase
{
    use RefreshDatabase;

    private SubscriptionService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $eventRepo = new EventRepository(new Event());
        $subRepo = new SubscriptionRepository(new EventUser());

        $this->service = new SubscriptionService($subRepo, $eventRepo);
    }

    public function test_it_does_not_allow_duplicate_subscriptions(): void
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['status' => 'active']);

        $this->actingAs($user)->post(route('events.subscribe', $event->id));

        $response = $this->actingAs($user)->post(route('events.subscribe', $event->id));

        $response->assertSessionHasErrors(['error']);

        $this->assertEquals(
            'You are already registered for this event!',
            session('errors')->get('error')[0]
        );
    }
}
