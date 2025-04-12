<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A job listing interest represents a user's interest in a job listing.
 * This is a many-to-many relationship between users and job listings.
 */
class JobListingInterest extends Model
{
    protected $fillable = [
        "user_id",
        "job_listing_id",
    ];
}
