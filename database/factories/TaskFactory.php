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

        $status = $this->faker->boolean();
        if ($status)
            $completedAt = $endingTime;
        else $completedAt = null;

        return [
            'title' => $this->faker->word(),
            'body' => $this->faker->paragraph(),
            'started_at' => $startingTime,
            'ended_at' => $endingTime,
            'slug' => \Illuminate\Support\Str::limit($this->faker->slug(), 20),
            'user_id' => User::factory(),
            'status' => $status,
            'completed_at' => $completedAt,
        ];
    }
}
