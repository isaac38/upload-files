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

        \App\Models\Files::factory()->create([
            'name' => 'primer archivo',
            'file' => 'pexels-andrea-piacquadio-3760067.jpg',
            'type' => 'jpg',
            'created_at' => '2024-02-03 02:54:57',
            'updated_at' => '2024-02-03 02:54:57'
        ]);
    }
}
