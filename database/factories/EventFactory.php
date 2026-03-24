<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph,
            'location' => $this->faker->address,
            'event_datetime' => now()->addDays(7),
            'end_date' => now()->addDays(7)->addHours(2),
            'people_capacity' => 50,
            'status' => 'active',
            'user_id' => User::factory(),
        ];
    }
}
