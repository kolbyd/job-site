<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Hash;
use Request;

class UserController extends Controller
{
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

        auth()->login($user);
        return redirect(route('index'))->with('success','User created successfully.');
    }

    public function login(LoginUserRequest $request)
    {
        // Validation is handled by the FormRequest
        
        // Locate the user
        $user = User::find($request->validated()['email']);
        if (!$user) {
            // Use non-descriptive error messages to prevent user enumeration
            flash()->error('Email and password combination do not match. Please try again.');
            return redirect()->back();
        }

        // Next, we need to verify the password
        $password = Hash::make($request->validated()['password'] . $user->salt);
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

    public function logout(Request $request)
    {
        auth()->logout();

        return redirect(route('index'))->with('success','Logged out successfully.');
    }
}
