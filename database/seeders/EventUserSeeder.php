<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();
        $users = User::all();

        if ($events->isEmpty() || $users->isEmpty()) {
            $this->command->info('Run UserSeeder and EventSeeder first!');

            return;
        }

        $events[0]->participants()->attach([
            $users[0]->id,
            $users[1]->id,
            $users[2]->id,
        ]);

        $events[1]->participants()->attach([
            $users[0]->id,
            $users[1]->id,
        ]);

        $events[2]->participants()->attach([
            $users[2]->id,
        ]);
    }
}
