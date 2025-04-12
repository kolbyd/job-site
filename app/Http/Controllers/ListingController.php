<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\User;

class ListingController extends Controller
{
    /**
     * The main page of the application.
     */
    public function index()
    {
        // Return listing data found in the last 2 months
        $listings = JobListing::where('created_at', '>=', now()->subMonths(2))
            ->orderByDesc('created_at')
            ->paginate(30);

        return view('index')->with("listings", $listings);
    }

    /**
     * Change the interest of the user in a job listing.
     * Will be front-end driven.
     */
    public function changeUserInterest(JobListing $listing)
    {
        /** @var User $user */
        $user = auth()->user();

        $change = null;
        if ($listing->userInterested($user)) {
            $listing->interestedUsers()->detach($user);
            $change = "removed";
        } else {
            $listing->interestedUsers()->attach($user);
            $change = "added";
        }

        return response()->json(["success" => true, "change" => $change]);
    }

    /**
     * Show a specific listing.
     */
    public function show(JobListing $listing)
    {
        return view("listing.index")->with("listing", $listing);
    }

    /**
     * Poster role listing. Admins can see all listings.
     */
    public function posterListingIndex()
    {
        /** @var User $user */
        $user = auth()->user();
        $listings = $user->isAdmin() ? JobListing::query() : $user->postings();

        $listings = $listings
            ->orderByDesc('created_at')
            ->paginate(30);

        return view('listing.poster-index')->with("listings", $listings);
    }
}
