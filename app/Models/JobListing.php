<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * A job listing represents a job that is available for users to add interests to.
 */
class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "body",
        "user_id",
    ];

    public function interestedUsers()
    {
        return $this->belongsToMany(User::class, 'job_listing_interests');
    }

    public function user()
    {
        return $this->belongsTo(User::class)
            ->withDefault(function ($user){
                $user->name = "Deleted User";
            });
    }

    public function userInterested(User $user)
    {
        return $this->interestedUsers()->where('user_id', $user->id)->exists();
    }
}
