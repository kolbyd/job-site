<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function CreateUser(CreateUserRequest $request)
    {
        // Validation is handled by the FormRequest
        $user = User::create($request->validated());
    }
}
