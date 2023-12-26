<?php

namespace Database\Factories;

use App\Models\User;
use DateInterval;
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
        $startingTime = $this->faker->dateTime();
        $endingTime = $startingTime;
        $endingTime->add(new DateInterval('PT4H'));
        return [
            'title' => $this->faker->word(),
            'body' => $this->faker->paragraph(),
            'starting_time' => $startingTime,
            'finishing_time' => $endingTime,
            'slug' => \Illuminate\Support\Str::limit($this->faker->slug(), 20),
            'user_id' => User::factory(),
            'status' => $this->faker->boolean()
        ];
    }
}
