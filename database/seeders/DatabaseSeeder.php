<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Task::factory(12)->create();  // todo : great usage of factories, now let's dig into a new challenge : create these tasks for a specific user.
        // todo : just bear in mind it seems to be better to define a new seeder (TaskSeeder) and define it here.
    }
}
