<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'sajjad',
            'email' => 'mohammadisajjad54@gmail.clom',
            'password' => bcrypt('12345678'),
        ]);
        Task::factory(12)->create([
            'user_id' => $user
        ]);
    }
}
