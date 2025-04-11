<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListingInterest extends Model
{
    protected $fillable = [
        "user_id",
        "job_listing_id",
    ];
}
