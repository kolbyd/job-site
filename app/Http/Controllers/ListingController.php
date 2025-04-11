<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        // Return listing data found in the last 2 months
        $listings = JobListing::where('created_at', '>=', now()->subMonths(2))
            ->orderByDesc('created_at')
            ->get();

        return view('index')->with("listings", $listings);
    }
}
