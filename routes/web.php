<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('events', EventController::class)->names([
        'index' => 'events.index',
        'show' => 'events.show',
        'store' => 'events.store',
        'update' => 'events.update',
        'destroy' => 'events.destroy',
    ]);

    Route::get('/events/{event}/subscribers', [SubscriptionController::class, 'getSubscribers']);
    Route::post('events/{event}/subscribe', [SubscriptionController::class, 'subscribe'])->name('events.subscribe');
    Route::post('events/{event}/unsubscribe', [SubscriptionController::class, 'unsubscribe'])->name('events.unsubscribe');
});

require __DIR__.'/auth.php';
