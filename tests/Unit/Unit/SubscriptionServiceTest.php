<?php

use App\Models\Event;
use App\Services\SubscriptionService;
use App\Repositories\EventRepository;
use App\Contracts\SubscriptionRepositoryContract;

test('should not allow duplicate subscriptions', function () {
    $mockSubRepo = Mockery::mock(SubscriptionRepositoryContract::class);
    $mockEventRepo = Mockery::mock(EventRepository::class);

    $eventMock = Mockery::mock(new Event(['id' => 1]))->makePartial();

    $mockEventRepo->shouldReceive('findByIdWithCount')->andReturn($eventMock);
    $eventMock->shouldReceive('isActive')->andReturn(true);
    $eventMock->shouldReceive('isUserSubscribed')->andReturn(true);


    $service = new SubscriptionService($mockSubRepo, $mockEventRepo);

    expect(fn() => $service->subscribe(1, 10))
        ->toThrow(Exception::class, "You are already registered for this event!");
});

test('should prevent subscription when the event is full', function () {
    $mockSubRepo = Mockery::mock(SubscriptionRepositoryContract::class);
    $mockEventRepo = Mockery::mock(EventRepository::class);

    $eventMock = Mockery::mock(new Event(['id' => 1]))->makePartial();

    $mockEventRepo->shouldReceive('findByIdWithCount')->andReturn($eventMock);
    $eventMock->shouldReceive('isActive')->andReturn(true);
    $eventMock->shouldReceive('isUserSubscribed')->andReturn(false);
    $eventMock->shouldReceive('isFull')->andReturn(true);

    $service = new SubscriptionService($mockSubRepo, $mockEventRepo);

    expect(fn() => $service->subscribe(1, 10))
        ->toThrow(Exception::class, "The event is full!");
});

test('should not allow a user to unsubscribe someone else', function () {
    $mockSubRepo = Mockery::mock(SubscriptionRepositoryContract::class);
    $mockEventRepo = Mockery::mock(EventRepository::class);

    $eventMock = Mockery::mock(new Event(['id' => 1]))->makePartial();
    
    $mockEventRepo->shouldReceive('findByIdWithCount')->andReturn($eventMock);
    $eventMock->shouldReceive('isUserSubscribed')
        ->with(10)
        ->andReturn(false);

    $service = new SubscriptionService($mockSubRepo, $mockEventRepo);

    expect(fn() => $service->unsubscribe(1, 10))
        ->toThrow(Exception::class, "You are not registered for this event!");
});

test('should only allow the event creator to view the subscriber list', function () {
    $mockSubRepo = Mockery::mock(SubscriptionRepositoryContract::class);
    $mockEventRepo = Mockery::mock(EventRepository::class);

    $eventMock = Mockery::mock(new Event(['id' => 1, 'user_id' => 99]))->makePartial();
    
    $mockEventRepo->shouldReceive('findById')->with(1)->andReturn($eventMock);

    $service = new SubscriptionService($mockSubRepo, $mockEventRepo);

    expect(fn() => $service->getSubscribers(1, 10))
        ->toThrow(Exception::class, "You are not authorized to view this subscriber list.");
});
