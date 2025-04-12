<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // User is already logged in if they get here (middleware)

        // Get the user from the request
        /** @var \App\Models\User $user */
        $user = auth()->user();

        // If this is an update, we need to verify that the user is allowed to modify the listing
        if ($this->route("listing")) {
            /** @var \App\Models\JobListing $listing */
            $listing = $this->route("listing");

            return $listing->canModify($user);
        }

        // This is a new listing, so we can authorize it
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'body' => 'required|string'
        ];
    }
}
