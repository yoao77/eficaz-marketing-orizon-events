<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\EventUser;
use App\Models\User;
use App\Services\SubscriptionService;
use App\Repositories\EventRepository;
use App\Repositories\SubscriptionRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function test_prevent_registration_in_full_event(): void
    {
        $event = Event::factory()->create([
            'status' => 'active',
            'people_capacity' => 1,
        ]);

        $firstUser = User::factory()->create();
        $event->participants()->attach($firstUser->id);

        $testUser = User::factory()->create();

        $response = $this->actingAs($testUser)
            ->post(route('events.subscribe', $event->id));

        $response->assertSessionHasErrors(['error']);

        $this->assertEquals(
            'The event is full!',
            session('errors')->get('error')[0]
        );

        $this->assertDatabaseMissing('event_user', [
            'event_id' => $event->id,
            'user_id' => $testUser->id,
        ]);
    }

    public function test_only_the_subscription_owner_can_cancel_it(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();

        $event = Event::factory()->create(['status' => 'active']);

        $event->participants()->attach($owner->id);

        $this->assertDatabaseHas('event_user', [
            'event_id' => $event->id,
            'user_id' => $owner->id
        ]);

        $response = $this->actingAs($intruder)
            ->post(route('events.unsubscribe', $event->id));

        $response->assertSessionHasErrors(['error']);

        $this->assertDatabaseHas('event_user', [
            'event_id' => $event->id,
            'user_id' => $owner->id
        ]);
    }

    /**
     * @test
     * [TECHNICAL DEBT]
     * TODO: Refactor SubscriptionController to return a structured JSON response (Resource).
     * Currently, the controller does not handle the Exception with a try/catch, 
     * which may cause a 500 error on the frontend instead of a clean 403 Forbidden.
     */
    public function test_only_event_creator_can_view_the_subscriber_list(): void
    {
        // 1. Create the Owner (Creator) and the Intruder
        $creator = User::factory()->create();
        $intruder = User::factory()->create();

        // 2. Create the event linked to the Owner
        $event = Event::factory()->create([
            'user_id' => $creator->id,
            'title' => 'My Secret Event'
        ]);

        // 3. The INTRUDER tries to access the subscribers list
        // We use the GET method as listing is typically a GET request
        $response = $this->actingAs($intruder)
            ->get(route('events.subscribers', $event->id));

        // 4. Assert Error
        // NOTE: If your Controller isn't catching the Exception yet, 
        // it might return a 500 status. Adjust this assertion as needed.
        $response->assertStatus(403);

        /* Optional: Validate the specific error message if using try/catch in the Controller
    $this->assertEquals(
        'You are not authorized to view this subscriber list.',
        session('errors')->get('error')[0]
    ); 
    */

        // 5. HAPPY PATH: The Owner accesses the list successfully
        $successResponse = $this->actingAs($creator)
            ->get(route('events.subscribers', $event->id));

        $successResponse->assertStatus(200);
    }
}
