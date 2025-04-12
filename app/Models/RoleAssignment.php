<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * A role assignment represents a user's role in the system.
 * Their role assignment determines what they can do in the system.
 */
class RoleAssignment extends Model
{
    /**
     * Missing from this class would be the assumed role for guest users.
     * For guests, we'll allow them to see job listings, but not job listing details or add interests.
     */

    /**
     * A viewer role will be able to: see job listings, see job listing details, and add interests.
     * They will not be able to add, edit, or delete job listings.
     * @var string
     */
    public const VIEWER_ROLE = "viewer";

    /**
     * A poster role will be able to: see job listings, see job listing details, add interests, 
     * add, edit, and delete THEIR OWN job listings, and see users who are interested in their job listings.
     * @var string
     */
    public const POSTER_ROLE = "poster";

    /**
     * An admin role will be able to: see job listings, see job listing details, add interests,
     * add, edit, and delete ALL job listings, and see users who are interested in any job listing.
     * @var string
     */
    public const ADMIN_ROLE = "admin";

    protected $fillable = [
        "user_id",
        "role_name"
    ];

    /**
     * Get the user that owns the role assignment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function AllRoles()
    {
        return [
            self::VIEWER_ROLE,
            self::POSTER_ROLE,
            self::ADMIN_ROLE
        ];
    }
}
