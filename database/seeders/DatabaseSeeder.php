<?php

namespace Database\Seeders;

use App\Models\JobListing;
use App\Models\JobListingInterest;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::getQuery()->delete();
        JobListing::getQuery()->delete();
        $listings = JobListing::factory()->count(100)->create();
        $users = User::factory()->count(100)->create();

        // For each listing, take a random amount of users and make them interested in the listing
        foreach ($listings as $listing) {
            // Get a random number of users to attach
            $countToAttach = rand(1, 100);
            $randomUsers = $users->shuffle()->take($countToAttach);

            // Attach the users to the listing
            $insertRecords = [];

            foreach($randomUsers as $user) {
                $insertRecords[] = [
                    'user_id' => $user->id,
                    'job_listing_id' => $listing->id
                ];
            }

            JobListingInterest::insert($insertRecords);
        }

    }
}
