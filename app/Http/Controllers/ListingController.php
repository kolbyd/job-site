<?php

namespace App\Http\Controllers;

use App\Models\JobListing;

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
            ->get();

        return view('index')->with("listings", $listings);
    }
}
