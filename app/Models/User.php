<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Str;

/**
 * A user represents a person who can log in to the system.
 * Users can have different roles and can express interest in job listings.
 * Certain users have greater privileges than others. @see RoleAssignment
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'salt'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'salt',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's role assignments.
     */
    public function roleAssignments()
    {
        return $this->hasMany(RoleAssignment::class);
    }

    /**
     * Check if user has a role
     */
    public function hasRole(string $role): bool
    {
        $roleAssignments = $this->roleAssignments()->get();
        if ($roleAssignments->isEmpty()) {
            return false;
        }
        
        // Check if the user has the specified role
        foreach ($roleAssignments as $roleAssignment) {
            if (Str::upper($roleAssignment->role_name) === Str::upper($role)) {
                return true;
            }
        }

        // Base case
        return false;
    }

    /**
     * Role specifics
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(RoleAssignment::ADMIN_ROLE);
    }

    public function isViewer(): bool
    {
        return $this->isAdmin() || $this->hasRole(RoleAssignment::VIEWER_ROLE);
    }

    public function isPoster(): bool
    {
        return $this->isAdmin() || $this->hasRole(RoleAssignment::POSTER_ROLE);
    }
}
