<?php

namespace App\Http\Requests;

use App\Models\RoleAssignment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * A request to create a new user.
 */
class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => "required|string|max:255",
            'email' => "required|email|max:255|unique:users,username",
            'password' => "required|string|min:8|confirmed",
            'roles' => [ "array", Rule::in(RoleAssignment::AllRoles()) ]
        ];
    }
}
