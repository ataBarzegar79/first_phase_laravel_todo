<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'body' => $this->faker->paragraph(),
            'starting_time' => $startingTime = $this->faker->dateTime(),
            'finishing_time' => $this->faker->dateTimeBetween($startingTime,  $startingTime->modify('+4 hours')),
            'slug' => \Illuminate\Support\Str::limit($this->faker->slug(), 20),
            'user_id' => User::factory(),
        ];
    }
}
