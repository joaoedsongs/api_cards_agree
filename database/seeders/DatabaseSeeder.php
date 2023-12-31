<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User One',
            'email' => 'postman@example.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User Two',
            'email' => 'front@example.com',
        ]);
        $this->call(ExpansionSeeder::class);
        $this->call(RaritySeeder::class);
        $this->call(TypeSeeder::class);
    }
}
