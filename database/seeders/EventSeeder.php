<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::take(3)->get();

        if ($users->count() < 1) {
            $this->command->info('No users found. Run UserSeeder first!');

            return;
        }

        Event::create([
            'user_id' => $users[0]->id,
            'title' => 'Festa de Aniversário',
            'description' => 'Uma festa divertida com amigos e familiares.',
            'location' => 'Rua das Flores, 123',
            'event_datetime' => Carbon::now()->addDays(10),
            'people_capacity' => 50,
            'status' => 'active',
        ]);

        Event::create([
            'user_id' => $users[1]->id,
            'title' => 'Workshop de Laravel',
            'description' => 'Aprenda Laravel com instrutores experientes.',
            'location' => 'Centro de Convenções',
            'event_datetime' => Carbon::now()->addDays(20)->setTime(14, 0),
            'people_capacity' => 100,
            'status' => 'active',
        ]);

        Event::create([
            'user_id' => $users[2]->id,
            'title' => 'Piquenique no Parque',
            'description' => 'Um dia de diversão ao ar livre.',
            'location' => 'Parque Central',
            'event_datetime' => Carbon::now()->addDays(5)->setTime(10, 30),
            'people_capacity' => 30,
            'status' => 'active',
        ]);
    }
}
