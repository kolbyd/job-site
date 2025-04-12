<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\RoleAssignment;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Str;

/**
 * UserController handles user registration and login.
 * 
 * All POST requests use FormRequest classes to validate input.
 * @see app/Http/Requests
 */
class UserController extends Controller
{
    /**
     * Create a new user and log them in as that user (if successful).
     * @param \App\Http\Requests\CreateUserRequest $request The request object containing the user data.
     * @return \Illuminate\Http\RedirectResponse Redirects to the main page on success, or back with an error message on failure.
     */
    public function create(CreateUserRequest $request)
    {
        // Validation is handled by the FormRequest
        $salt = bin2hex(random_bytes(16));
        $user = User::create([
            'name' => $request->validated()['name'],
            'username' => $request->validated()['email'],
            'password' => Hash::make($request->validated()['password'].$salt),
            'salt' => $salt,
        ]);

        // Assign the user a default role
        RoleAssignment::create([
            'user_id' => $user->id,
            'role_name' => RoleAssignment::VIEWER_ROLE
        ]);

        auth()->login($user);
        flash()->success('User created successfully.');
        return redirect(route('index'));
    }

    /**
     * Login a user.
     * @param \App\Http\Requests\LoginUserRequest $request The request object containing the login data.
     * @return mixed|\Illuminate\Http\RedirectResponse Redirects to the main page on success, or back with an error message on failure.
     */
    public function login(LoginUserRequest $request)
    {
        // Validation is handled by the FormRequest
        
        // Locate the user
        $user = User::whereUsername($request->validated()['email'])->first();
        if (!$user) {
            // Use non-descriptive error messages to prevent user enumeration
            flash()->error('Email and password combination do not match. Please try again.');
            return redirect()->back();
        }

        // Next, we need to verify the password
        $password = $request->validated()['password'] . $user->salt;
        if (Hash::check($password, $user->password)) {
            // Password is correct, log the user in
            auth()->login($user);
            flash()->success('Login successful!');

            return redirect()->intended(route('index'));
        } else {
            // Use non-descriptive error messages to prevent user enumeration
            flash()->error('Email and password combination do not match. Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Logout the user.
     * In the routing this is protected by the auth middleware, so this doesn't need to be verified.
     * @return \Illuminate\Http\RedirectResponse Redirects to the main page with a success message.
     */
    public function logout()
    {
        auth()->logout();

        return redirect(route('index'))->with('success','Logged out successfully.');
    }

    /**
     * Admin methods.
     */
    /**
     * Show the user management page, allow the admin to search for users.
     * @return \Illuminate\Contracts\View\View A view of the user management page.
     */
    public function adminUserIndex()
    {
        // Allow for searching by name or email
        if (request('search')) {
            $users = User::where('name', 'like', '%' . request('search') . '%')
                ->orWhere('username', 'like', '%' . request('search') . '%');
        } else {
            $users = User::query();
        }

        return view('admin.user-management')->with('users', $users->paginate(50));
    }

    /**
     * Summary of adminUpdateUserRole
     * @param \App\Models\User $user
     * @param string $role
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function adminUpdateUserRole(User $user, string $role)
    {
        // Ensure role is one of our defined roles
        if ( Str::upper($role) !== Str::upper(RoleAssignment::VIEWER_ROLE) &&
            Str::upper($role) !== Str::upper(RoleAssignment::POSTER_ROLE) &&
            Str::upper($role) !== Str::upper(RoleAssignment::ADMIN_ROLE) ) {
            return response()->json(["success" => false, "message" => "Invalid role."]);
        }

        // Don't allow the user to remove their own admin role
        if ($user->id === auth()->user()->id && Str::upper($role) === Str::upper(RoleAssignment::ADMIN_ROLE)) {
            return response()->json(["success" => false, "message" => "You cannot remove your own admin role."]);
        }

        // Check if the user already has the role
        if ($user->hasRole($role)) {
            $user->roleAssignments()->where('role_name', $role)->delete();
            $change = "removed";
        } else {
            // Assign the role to the user
            $user->roleAssignments()->create(['role_name' => $role]);
            $change = "added";
        }

        return response()->json(["success" => true, "change" => $change]);
    }

    /**
     * Admin method to delete a user.
     * This method is protected by the auth middleware, so this doesn't need to be verified.
     * @param \App\Models\User $user The user to delete.
     * @return mixed|\Illuminate\Http\RedirectResponse Redirects to the user management page with a success/error message.
     */
    public function adminDestroyUser(User $user)
    {
        // Check if the user is an admin
        if ($user->isAdmin()) {
            flash()->error('You cannot delete an admin user.');
            return redirect()->back();
        }

        // Delete the user
        $user->delete();

        flash()->success('User deleted successfully.');
        return redirect()->back();
    }
}
