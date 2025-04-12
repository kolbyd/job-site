<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'body' => $this->faker->paragraph(5),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
