<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\RoleAssignment;
use App\Models\User;
use Hash;

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
            return redirect()->route('index');
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
}
