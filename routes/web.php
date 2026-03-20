<?php

use App\Http\Controllers\ProfileController;
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
});

Route::get('/my-events', function () {
    $events = [
        (object)[
            'title' => 'Conferência Biohit 2026',
            'description' => 'Discussão sobre relatórios automatizados e integração com Excel.',
            'location' => 'São Paulo, SP',
            'date_time' => '2026-05-20 09:00:00',
            'status' => 'active'
        ],
        (object)[
            'title' => 'Data Sloth Workshop',
            'description' => 'Treinamento prático de ingestão de dados com Kafka.',
            'location' => 'Remoto',
            'date_time' => '2026-06-15 14:30:00',
            'status' => 'pending'
        ],
    ];

    return view('events.index', compact('events'));
})->middleware(['auth']);



require __DIR__ . '/auth.php';
