<?php

namespace Database\Factories;

use App\Models\RoleAssignment;
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
            'body' => $this->faker->paragraphs(3, true),
            'user_id' => function () {
                $user = User::factory()->create();
                $user->roleAssignments()->create(['role_name' => RoleAssignment::POSTER_ROLE]);
                return $user->id;
            },
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
