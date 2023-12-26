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
         \App\Models\User::factory(9)->create();
         $i = 1;
         while ($i <= 10)
         {
             \App\Models\Task::factory(10)->create([
                 'user_id' => $i,
             ]);
             $i++;
         }
    }
}
