<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Alice Silva',
            'email' => 'alice@example.com',
            'password' => Hash::make('senha123'),
        ]);

        User::create([
            'name' => 'Bruno Souza',
            'email' => 'bruno@example.com',
            'password' => Hash::make('senha123'),
        ]);

        User::create([
            'name' => 'Carla Lima',
            'email' => 'carla@example.com',
            'password' => Hash::make('senha123'),
        ]);
    }
}
