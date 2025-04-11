<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleAssignment extends Model
{
    public const VIEWER_ROLE = "viewer";
    public const POSTER_ROLE = "poster";
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
