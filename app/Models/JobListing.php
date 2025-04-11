<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = [
        "title",
        "body",
        "user_id",
    ];

    public function interestedUsers()
    {
        return $this->belongsToMany(User::class, 'job_listing_interests');
    }
}
